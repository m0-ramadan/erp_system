<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProductController extends AdminCrudController
{
    protected string $modelClass = Product::class;
    protected string $viewPath = 'Admin.products';
    protected array $with = ['specs'];
    protected array $searchable = ['sku', 'name', 'category'];
    protected array $filterable = ['category', 'is_active'];
    protected array $storeRules = [
    'sku' => 'required|string|max:100|unique:products,sku',
    'name' => 'required|string|max:255',
    'category' => 'nullable|string|max:150',
    'unit' => 'required|string|max:50',
    'description' => 'nullable|string',
    'is_active' => 'nullable|boolean',
    ];
    protected array $updateRules = [
    'sku' => 'required|string|max:100',
    'name' => 'required|string|max:255',
    'category' => 'nullable|string|max:150',
    'unit' => 'required|string|max:50',
    'description' => 'nullable|string',
    'is_active' => 'nullable|boolean',
    ];
}
