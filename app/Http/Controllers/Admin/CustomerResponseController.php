<?php

namespace App\Http\Controllers\Admin;

use App\Models\CustomerResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerResponseController extends AdminCrudController
{
    protected string $modelClass = CustomerResponse::class;
    protected string $viewPath = 'Admin.customer_responses';
    protected array $with = ['quotation', 'quotationVersion', 'customer', 'contact'];
    protected array $searchable = ['response_notes', 'revision_details', 'rejection_reason'];
    protected array $filterable = ['quotation_id', 'quotation_version_id', 'customer_id', 'contact_id', 'response', 'recorded_by'];
    protected array $storeRules = [
    'quotation_id' => 'required|exists:quotations,id',
    'quotation_version_id' => 'nullable|exists:quotation_versions,id',
    'customer_id' => 'nullable|exists:customers,id',
    'contact_id' => 'nullable|exists:customer_contacts,id',
    'response' => 'required|in:pending,accepted,rejected,revision_requested,no_response',
    'response_notes' => 'nullable|string',
    'revision_details' => 'nullable|string',
    'rejection_reason' => 'nullable|string',
    'responded_at' => 'nullable|date',
    'recorded_by' => 'nullable|exists:users,id',
    ];
    protected array $updateRules = [
    'quotation_id' => 'required|exists:quotations,id',
    'quotation_version_id' => 'nullable|exists:quotation_versions,id',
    'customer_id' => 'nullable|exists:customers,id',
    'contact_id' => 'nullable|exists:customer_contacts,id',
    'response' => 'required|in:pending,accepted,rejected,revision_requested,no_response',
    'response_notes' => 'nullable|string',
    'revision_details' => 'nullable|string',
    'rejection_reason' => 'nullable|string',
    'responded_at' => 'nullable|date',
    'recorded_by' => 'nullable|exists:users,id',
    ];
}
