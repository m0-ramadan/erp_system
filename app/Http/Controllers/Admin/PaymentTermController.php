<?php

namespace App\Http\Controllers\Admin;

use App\Models\PaymentTerm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PaymentTermController extends AdminCrudController
{
    protected string $modelClass = PaymentTerm::class;
    protected string $viewPath = 'Admin.payment_terms';
    protected array $with = [];
    protected array $searchable = ['code', 'name'];
    protected array $filterable = ['is_active'];
    protected array $storeRules = [
    'code' => 'required|string|max:80|unique:payment_terms,code',
    'name' => 'required|string|max:180',
    'description' => 'nullable|string',
    'days_count' => 'nullable|integer|min:0',
    'is_active' => 'nullable|boolean',
    ];
    protected array $updateRules = [
    'code' => 'required|string|max:80',
    'name' => 'required|string|max:180',
    'description' => 'nullable|string',
    'days_count' => 'nullable|integer|min:0',
    'is_active' => 'nullable|boolean',
    ];
}
