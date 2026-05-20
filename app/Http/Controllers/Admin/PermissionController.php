<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PermissionController extends AdminCrudController
{
    protected string $modelClass = Permission::class;
    protected string $viewPath = 'Admin.permissions';
    protected array $with = [];
    protected array $searchable = ['code', 'name', 'module'];
    protected array $filterable = ['module'];
    protected array $storeRules = [
    'code' => 'required|string|max:120|unique:permissions,code',
    'name' => 'required|string|max:180',
    'module' => 'required|string|max:80',
    'description' => 'nullable|string',
    ];
    protected array $updateRules = [
    'code' => 'required|string|max:120',
    'name' => 'required|string|max:180',
    'module' => 'required|string|max:80',
    'description' => 'nullable|string',
    ];
}
