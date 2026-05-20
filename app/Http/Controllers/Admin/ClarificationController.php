<?php

namespace App\Http\Controllers\Admin;

use App\Models\Clarification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClarificationController extends AdminCrudController
{
    protected string $modelClass = Clarification::class;
    protected string $viewPath = 'Admin.clarifications';
    protected array $with = ['quoteRequest', 'requester', 'assignedUser'];
    protected array $searchable = ['question', 'response'];
    protected array $filterable = ['quote_request_id', 'requested_by', 'assigned_to', 'status'];
    protected array $storeRules = [
    'quote_request_id' => 'required|exists:quote_requests,id',
    'requested_by' => 'nullable|exists:users,id',
    'assigned_to' => 'nullable|exists:users,id',
    'question' => 'required|string',
    'response' => 'nullable|string',
    'status' => 'nullable|in:open,answered,closed,cancelled',
    'requested_at' => 'nullable|date',
    'responded_at' => 'nullable|date',
    'closed_at' => 'nullable|date',
    ];
    protected array $updateRules = [
    'quote_request_id' => 'required|exists:quote_requests,id',
    'requested_by' => 'nullable|exists:users,id',
    'assigned_to' => 'nullable|exists:users,id',
    'question' => 'required|string',
    'response' => 'nullable|string',
    'status' => 'nullable|in:open,answered,closed,cancelled',
    'requested_at' => 'nullable|date',
    'responded_at' => 'nullable|date',
    'closed_at' => 'nullable|date',
    ];
}
