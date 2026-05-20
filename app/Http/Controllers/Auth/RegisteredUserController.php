<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        $includeAdmin = \App\Models\User::query()->count() === 0;
        $roles = $this->registerableRoles($includeAdmin);

        if ($roles->isEmpty()) {
            return redirect()
                ->route('login')
                ->with('error', 'لا توجد أدوار متاحة للتسجيل حاليًا. شغّل الـ seeder أو أضف الأدوار أولًا.');
        }

        return view('auth.register', compact('roles', 'includeAdmin'));
    }

    public function store(Request $request): RedirectResponse
    {
        $includeAdmin = \App\Models\User::query()->count() === 0;
        $roles = $this->registerableRoles($includeAdmin);

        if ($roles->isEmpty()) {
            return redirect()
                ->route('login')
                ->with('error', 'لا توجد أدوار متاحة للتسجيل حاليًا.');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:180'],
            'email' => ['required', 'email', 'max:180', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:50'],
            'role_code' => ['required', 'string', Rule::in($roles->pluck('code')->all())],
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [], [
            'name' => 'الاسم',
            'email' => 'البريد الإلكتروني',
            'phone' => 'رقم الهاتف',
            'role_code' => 'نوع الحساب',
            'password' => 'كلمة المرور',
        ]);

        $selectedRole = $roles->firstWhere('code', $data['role_code']);

        $user = DB::transaction(function () use ($data, $selectedRole) {
            $user = User::create([
                'employee_code' => null,
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'password' => Hash::make($data['password']),
                'department_id' => $selectedRole?->department_id,
                'is_active' => true,
            ]);

            $user->forceFill([
                'employee_code' => $this->buildEmployeeCode($selectedRole?->code, $user->id),
            ])->save();

            $user->roles()->syncWithoutDetaching([$selectedRole->id]);

            return $user;
        });

        event(new Registered($user));
        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard')
            ->with('success', 'تم إنشاء الحساب بنجاح.');
    }

    protected function registerableRoles(bool $includeAdmin = false)
    {
        $allowedCodes = $includeAdmin
            ? ['ADMIN', 'SALES_REP', 'DESIGNER']
            : ['SALES_REP', 'DESIGNER'];

        $roles = Role::query()
            ->whereIn('code', $allowedCodes)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return collect($allowedCodes)
            ->map(fn (string $code) => $roles->firstWhere('code', $code))
            ->filter()
            ->values();
    }

    protected function buildEmployeeCode(?string $roleCode, int $userId): string
    {
        $prefix = match ($roleCode) {
            'ADMIN' => 'ADM',
            'DESIGNER' => 'DSN',
            'SALES_REP' => 'REP',
            default => 'USR',
        };

        return sprintf('%s-%04d', $prefix, $userId);
    }
}
