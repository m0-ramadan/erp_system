<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

    class User extends Authenticatable
    {
        use HasApiTokens, HasFactory, Notifiable;

        protected $table = 'users';

        protected $fillable = [
            'employee_code',
        'name',
        'email',
        'phone',
        'password',
        'department_id',
        'manager_user_id',
        'is_active',
        'last_login_at'
        ];


        protected $hidden = [
            'password',
        'remember_token'
        ];


        protected $casts = [
            'is_active' => 'boolean',
        'last_login_at' => 'datetime',
        'email_verified_at' => 'datetime'
        ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_user_id');
    }

    public function subordinates()
    {
        return $this->hasMany(User::class, 'manager_user_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'user_permissions')->withPivot('allowed');
    }

    public function assignedCustomers()
    {
        return $this->hasMany(Customer::class, 'assigned_sales_rep_id');
    }

    public function quoteRequests()
    {
        return $this->hasMany(QuoteRequest::class, 'created_by');
    }

    public function salesOrders()
    {
        return $this->hasMany(SalesOrder::class, 'created_by');
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('ADMIN');
    }

    public function hasRole(string $code): bool
    {
        $this->loadMissing('roles');

        return $this->roles
            ->where('is_active', true)
            ->contains(fn (Role $role) => $role->code === $code);
    }

    public function hasPermission(string $code): bool
    {
        if (! $this->is_active) {
            return false;
        }

        if ($this->isAdmin()) {
            return true;
        }

        $this->loadMissing('permissions', 'roles.permissions');

        $directPermission = $this->permissions->firstWhere('code', $code);

        if ($directPermission) {
            return (bool) $directPermission->pivot->allowed;
        }

        return $this->roles
            ->where('is_active', true)
            ->flatMap(fn (Role $role) => $role->permissions)
            ->contains('code', $code);
    }

    public function hasAnyPermission(iterable|string ...$permissions): bool
    {
        $codes = collect($permissions)
            ->flatten()
            ->filter()
            ->map(fn ($permission) => (string) $permission)
            ->unique()
            ->values();

        foreach ($codes as $code) {
            if ($this->hasPermission($code)) {
                return true;
            }
        }

        return false;
    }
}
