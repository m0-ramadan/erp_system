<?php

namespace App\Http\Controllers\Admin;

use App\Models\WorkflowTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WorkflowTaskController extends AdminCrudController
{
    protected string $modelClass = WorkflowTask::class;
    protected string $viewPath = 'Admin.workflow_tasks';
    protected array $with = ['instance', 'step', 'assignedUser'];
    protected array $searchable = ['step_code', 'assigned_role_code', 'result_code'];
    protected array $filterable = ['workflow_instance_id', 'step_code', 'assigned_role_code', 'assigned_user_id', 'task_status'];
    protected array $storeRules = [
    'workflow_instance_id' => 'required|exists:workflow_instances,id',
    'step_code' => 'required|exists:workflow_steps,code',
    'assigned_role_code' => 'nullable|string|max:80',
    'assigned_user_id' => 'nullable|exists:users,id',
    'task_status' => 'nullable|in:open,in_progress,completed,skipped,cancelled,rejected',
    'due_at' => 'nullable|date',
    'started_at' => 'nullable|date',
    'completed_at' => 'nullable|date',
    'result_code' => 'nullable|string|max:100',
    'result_notes' => 'nullable|string',
    ];
    protected array $updateRules = [
    'workflow_instance_id' => 'required|exists:workflow_instances,id',
    'step_code' => 'required|exists:workflow_steps,code',
    'assigned_role_code' => 'nullable|string|max:80',
    'assigned_user_id' => 'nullable|exists:users,id',
    'task_status' => 'nullable|in:open,in_progress,completed,skipped,cancelled,rejected',
    'due_at' => 'nullable|date',
    'started_at' => 'nullable|date',
    'completed_at' => 'nullable|date',
    'result_code' => 'nullable|string|max:100',
    'result_notes' => 'nullable|string',
    ];
}
