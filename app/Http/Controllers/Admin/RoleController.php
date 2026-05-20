<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RoleController extends AdminCrudController
{
    protected string $modelClass = Role::class;
    protected string $viewPath = 'Admin.roles';
    protected array $with = ['department', 'permissions'];
    protected array $searchable = ['code', 'name'];
    protected array $filterable = ['department_id', 'is_active', 'is_system_role'];
    protected array $storeRules = [
    'code' => 'required|string|max:80|unique:roles,code',
    'name' => 'required|string|max:150',
    'department_id' => 'nullable|exists:departments,id',
    'description' => 'nullable|string',
    'is_system_role' => 'nullable|boolean',
    'is_active' => 'nullable|boolean',
    ];
    protected array $updateRules = [
    'code' => 'required|string|max:80',
    'name' => 'required|string|max:150',
    'department_id' => 'nullable|exists:departments,id',
    'description' => 'nullable|string',
    'is_system_role' => 'nullable|boolean',
    'is_active' => 'nullable|boolean',
    ];
}
