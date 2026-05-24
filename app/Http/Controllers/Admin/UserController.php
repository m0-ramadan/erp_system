<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends AdminCrudController
{
    protected string $modelClass = User::class;
    protected string $viewPath = 'Admin.users';
    protected array $with = ['department', 'roles'];
    protected array $searchable = ['employee_code', 'name', 'email', 'phone'];
    protected array $filterable = ['department_id', 'is_active', 'manager_user_id'];
    protected array $storeRules = [
        'employee_code' => 'nullable|string|max:80|unique:users,employee_code',
        'name' => 'required|string|max:180',
        'email' => 'required|email|max:180|unique:users,email',
        'phone' => 'nullable|string|max:50',
        'password' => 'required|string|min:6',
        'role_id' => 'required|exists:roles,id',
        'department_id' => 'nullable|exists:departments,id',
        'manager_user_id' => 'nullable|exists:users,id',
        'is_active' => 'nullable|boolean',
    ];
    protected array $updateRules = [
        'employee_code' => 'nullable|string|max:80',
        'name' => 'required|string|max:180',
        'email' => 'required|email|max:180',
        'phone' => 'nullable|string|max:50',
        'password' => 'nullable|string|min:6',
        'role_id' => 'required|exists:roles,id',
        'department_id' => 'nullable|exists:departments,id',
        'manager_user_id' => 'nullable|exists:users,id',
        'is_active' => 'nullable|boolean',
    ];

    public function create(Request $request)
    {
        $formData = $this->formData();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                ...$formData,
            ]);
        }

        return view($this->viewPath . '.create', $formData);
    }

    public function edit(Request $request, $id)
    {
        $item = $this->modelClass::with($this->with)->findOrFail($id);
        $formData = $this->formData($item);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => $item,
                ...$formData,
            ]);
        }

        return view($this->viewPath . '.edit', [
            'item' => $item,
            ...$formData,
        ]);
    }

    protected function beforeStore(array $data, Request $request): array
    {
        $data = $this->prepareRoleSelection($data, $request);

        if (empty($data['employee_code'])) {
            $data['employee_code'] = null;
        }

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $data;
    }

    protected function afterStore(Model $item, Request $request): void
    {
        $this->syncUserRole($item, $request->attributes->get('selected_role_id'));
    }

    protected function beforeUpdate(array $data, Request $request, Model $item): array
    {
        $data = $this->prepareRoleSelection($data, $request);

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $data;
    }

    protected function afterUpdate(Model $item, Request $request): void
    {
        $this->syncUserRole($item, $request->attributes->get('selected_role_id'));
    }

    protected function prepareRoleSelection(array $data, Request $request): array
    {
        $roleId = isset($data['role_id']) ? (int) $data['role_id'] : null;
        $request->attributes->set('selected_role_id', $roleId);
        unset($data['role_id']);

        if (empty($data['department_id'])) {
            $data['department_id'] = Role::query()
                ->whereKey($roleId)
                ->value('department_id');
        }

        return $data;
    }

    protected function syncUserRole(Model $item, ?int $roleId): void
    {
        if (! $item instanceof User) {
            return;
        }

        $item->roles()->sync($roleId ? [$roleId] : []);
    }

    protected function formData(?User $item = null): array
    {
        $selectedRoleId = old('role_id', $item?->roles->first()?->id);

        return [
            'roles' => Role::query()
                ->where('is_active', true)
                ->orderBy('name')
                ->get(['id', 'name', 'code']),
            'departments' => Department::query()
                ->orderBy('name')
                ->get(['id', 'name']),
            'managers' => User::query()
                ->when($item, fn ($query) => $query->whereKeyNot($item->id))
                ->orderBy('name')
                ->get(['id', 'name']),
            'selectedRoleId' => $selectedRoleId,
        ];
    }

    protected function successResponse(Request $request, Model $item, string $message)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $item,
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', $message);
    }
}
