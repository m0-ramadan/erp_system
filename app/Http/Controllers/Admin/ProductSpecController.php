<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductSpec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProductSpecController extends AdminCrudController
{
    protected string $modelClass = ProductSpec::class;
    protected string $viewPath = 'Admin.product_specs';
    protected array $with = ['product'];
    protected array $searchable = ['spec_name', 'spec_value'];
    protected array $filterable = ['product_id', 'is_required'];
    protected array $storeRules = [
    'product_id' => 'required|exists:products,id',
    'spec_name' => 'required|string|max:150',
    'spec_value' => 'nullable|string',
    'unit' => 'nullable|string|max:50',
    'is_required' => 'nullable|boolean',
    ];
    protected array $updateRules = [
    'product_id' => 'required|exists:products,id',
    'spec_name' => 'required|string|max:150',
    'spec_value' => 'nullable|string',
    'unit' => 'nullable|string|max:50',
    'is_required' => 'nullable|boolean',
    ];
}
