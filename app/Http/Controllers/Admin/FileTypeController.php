<?php

namespace App\Http\Controllers\Admin;

use App\Models\FileType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FileTypeController extends AdminCrudController
{
    protected string $modelClass = FileType::class;
    protected string $viewPath = 'Admin.file_types';
    protected array $with = [];
    protected array $searchable = ['code', 'name'];
    protected array $filterable = ['is_active'];
    protected array $storeRules = [
    'code' => 'required|string|max:50|unique:file_types,code',
    'name' => 'required|string|max:120',
    'allowed_extensions' => 'nullable|string|max:255',
    'max_size_mb' => 'nullable|integer|min:1',
    'is_active' => 'nullable|boolean',
    ];
    protected array $updateRules = [
    'code' => 'required|string|max:50',
    'name' => 'required|string|max:120',
    'allowed_extensions' => 'nullable|string|max:255',
    'max_size_mb' => 'nullable|integer|min:1',
    'is_active' => 'nullable|boolean',
    ];
}
