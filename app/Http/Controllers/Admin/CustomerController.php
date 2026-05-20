<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends AdminCrudController
{
    protected string $modelClass = Customer::class;
    protected string $viewPath = 'Admin.customers';
    protected array $with = ['contacts', 'assignedSalesRep'];
    protected array $searchable = ['customer_code', 'company_name', 'email', 'phone', 'tax_number'];
    protected array $filterable = ['customer_type', 'status', 'assigned_sales_rep_id', 'city', 'country'];
    protected array $storeRules = [
    'customer_code' => 'required|string|max:80|unique:customers,customer_code',
    'company_name' => 'required|string|max:255',
    'customer_type' => 'required|in:new,existing,prospect',
    'tax_number' => 'nullable|string|max:100',
    'commercial_register' => 'nullable|string|max:100',
    'email' => 'nullable|email|max:180',
    'phone' => 'nullable|string|max:80',
    'address_line1' => 'nullable|string|max:255',
    'address_line2' => 'nullable|string|max:255',
    'city' => 'nullable|string|max:120',
    'country' => 'nullable|string|max:120',
    'assigned_sales_rep_id' => 'nullable|exists:users,id',
    'status' => 'nullable|in:active,inactive,blacklisted',
    'notes' => 'nullable|string',
    'created_by' => 'nullable|exists:users,id',
    ];
    protected array $updateRules = [
    'customer_code' => 'required|string|max:80',
    'company_name' => 'required|string|max:255',
    'customer_type' => 'required|in:new,existing,prospect',
    'tax_number' => 'nullable|string|max:100',
    'commercial_register' => 'nullable|string|max:100',
    'email' => 'nullable|email|max:180',
    'phone' => 'nullable|string|max:80',
    'address_line1' => 'nullable|string|max:255',
    'address_line2' => 'nullable|string|max:255',
    'city' => 'nullable|string|max:120',
    'country' => 'nullable|string|max:120',
    'assigned_sales_rep_id' => 'nullable|exists:users,id',
    'status' => 'nullable|in:active,inactive,blacklisted',
    'notes' => 'nullable|string',
    'created_by' => 'nullable|exists:users,id',
    ];
}
