<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DepartmentController extends AdminCrudController
{
    protected string $modelClass = Department::class;
    protected string $viewPath = 'Admin.departments';
    protected array $with = [];
    protected array $searchable = ['code', 'name'];
    protected array $filterable = ['is_active'];
    protected array $storeRules = [
    'code' => 'required|string|max:50|unique:departments,code',
    'name' => 'required|string|max:150',
    'description' => 'nullable|string',
    'is_active' => 'nullable|boolean',
    ];
    protected array $updateRules = [
    'code' => 'required|string|max:50',
    'name' => 'required|string|max:150',
    'description' => 'nullable|string',
    'is_active' => 'nullable|boolean',
    ];
}
