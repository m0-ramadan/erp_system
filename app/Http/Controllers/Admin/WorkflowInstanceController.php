<?php

namespace App\Http\Controllers\Admin;

use App\Models\WorkflowInstance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WorkflowInstanceController extends AdminCrudController
{
    protected string $modelClass = WorkflowInstance::class;
    protected string $viewPath = 'Admin.workflow_instances';
    protected array $with = ['currentStep', 'starter', 'openTasks'];
    protected array $searchable = ['entity_type', 'current_step_code'];
    protected array $filterable = ['entity_type', 'current_step_code', 'status', 'started_by'];
    protected array $storeRules = [
    'entity_type' => 'required|in:quote_request,quotation,sales_order,job_ticket,invoice',
    'entity_id' => 'required|integer|min:1',
    'current_step_code' => 'nullable|exists:workflow_steps,code',
    'status' => 'nullable|in:active,on_hold,completed,cancelled,rejected',
    'started_by' => 'nullable|exists:users,id',
    'started_at' => 'nullable|date',
    'completed_at' => 'nullable|date',
    'cancelled_at' => 'nullable|date',
    ];
    protected array $updateRules = [
    'entity_type' => 'required|in:quote_request,quotation,sales_order,job_ticket,invoice',
    'entity_id' => 'required|integer|min:1',
    'current_step_code' => 'nullable|exists:workflow_steps,code',
    'status' => 'nullable|in:active,on_hold,completed,cancelled,rejected',
    'started_by' => 'nullable|exists:users,id',
    'started_at' => 'nullable|date',
    'completed_at' => 'nullable|date',
    'cancelled_at' => 'nullable|date',
    ];
}
