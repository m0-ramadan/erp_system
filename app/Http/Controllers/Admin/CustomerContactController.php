<?php

namespace App\Http\Controllers\Admin;

use App\Models\CustomerContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerContactController extends AdminCrudController
{
    protected string $modelClass = CustomerContact::class;
    protected string $viewPath = 'Admin.customer_contacts';
    protected array $with = ['customer'];
    protected array $searchable = ['contact_name', 'email', 'phone', 'job_title'];
    protected array $filterable = ['customer_id', 'is_primary'];
    protected array $storeRules = [
    'customer_id' => 'required|exists:customers,id',
    'contact_name' => 'required|string|max:180',
    'job_title' => 'nullable|string|max:150',
    'email' => 'nullable|email|max:180',
    'phone' => 'nullable|string|max:80',
    'is_primary' => 'nullable|boolean',
    'notes' => 'nullable|string',
    ];
    protected array $updateRules = [
    'customer_id' => 'required|exists:customers,id',
    'contact_name' => 'required|string|max:180',
    'job_title' => 'nullable|string|max:150',
    'email' => 'nullable|email|max:180',
    'phone' => 'nullable|string|max:80',
    'is_primary' => 'nullable|boolean',
    'notes' => 'nullable|string',
    ];
}
