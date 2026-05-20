<?php

namespace App\Http\Controllers\Admin;

use App\Models\WorkflowHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WorkflowHistoryController extends AdminCrudController
{
    protected string $modelClass = WorkflowHistory::class;
    protected string $viewPath = 'Admin.workflow_history';
    protected array $with = ['instance', 'fromStep', 'toStep', 'actor'];
    protected array $searchable = ['action_code', 'action_label', 'comments'];
    protected array $filterable = ['workflow_instance_id', 'from_step_code', 'to_step_code', 'action_code', 'acted_by'];
    protected array $storeRules = [
    'workflow_instance_id' => 'required|exists:workflow_instances,id',
    'from_step_code' => 'nullable|exists:workflow_steps,code',
    'to_step_code' => 'nullable|exists:workflow_steps,code',
    'transition_id' => 'nullable|exists:workflow_transitions,id',
    'action_code' => 'required|string|max:100',
    'action_label' => 'nullable|string|max:180',
    'comments' => 'nullable|string',
    'acted_by' => 'nullable|exists:users,id',
    'acted_at' => 'nullable|date',
    ];
    protected array $updateRules = [
    'workflow_instance_id' => 'required|exists:workflow_instances,id',
    'from_step_code' => 'nullable|exists:workflow_steps,code',
    'to_step_code' => 'nullable|exists:workflow_steps,code',
    'transition_id' => 'nullable|exists:workflow_transitions,id',
    'action_code' => 'required|string|max:100',
    'action_label' => 'nullable|string|max:180',
    'comments' => 'nullable|string',
    'acted_by' => 'nullable|exists:users,id',
    'acted_at' => 'nullable|date',
    ];
}
