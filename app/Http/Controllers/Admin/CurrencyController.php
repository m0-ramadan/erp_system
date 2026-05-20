<?php

namespace App\Http\Controllers\Admin;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CurrencyController extends AdminCrudController
{
    protected string $modelClass = Currency::class;
    protected string $viewPath = 'Admin.currencies';
    protected array $with = [];
    protected array $searchable = ['code', 'name'];
    protected array $filterable = ['is_base', 'is_active'];
    protected array $storeRules = [
    'code' => 'required|string|size:3|unique:currencies,code',
    'name' => 'required|string|max:80',
    'symbol' => 'nullable|string|max:10',
    'exchange_rate_to_base' => 'nullable|numeric|min:0',
    'is_base' => 'nullable|boolean',
    'is_active' => 'nullable|boolean',
    ];
    protected array $updateRules = [
    'code' => 'required|string|size:3',
    'name' => 'required|string|max:80',
    'symbol' => 'nullable|string|max:10',
    'exchange_rate_to_base' => 'nullable|numeric|min:0',
    'is_base' => 'nullable|boolean',
    'is_active' => 'nullable|boolean',
    ];
}
