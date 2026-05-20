<?php

namespace App\Http\Controllers\Admin;

use App\Models\WorkflowTransition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WorkflowTransitionController extends AdminCrudController
{
    protected string $modelClass = WorkflowTransition::class;
    protected string $viewPath = 'Admin.workflow_transitions';
    protected array $with = ['fromStep', 'toStep'];
    protected array $searchable = ['from_step_code', 'to_step_code', 'condition_code', 'condition_label'];
    protected array $filterable = ['from_step_code', 'to_step_code', 'condition_code', 'is_default'];
    protected array $storeRules = [
    'from_step_code' => 'required|exists:workflow_steps,code',
    'to_step_code' => 'required|exists:workflow_steps,code',
    'condition_code' => 'nullable|string|max:100',
    'condition_label' => 'nullable|string|max:180',
    'is_default' => 'nullable|boolean',
    'description' => 'nullable|string',
    ];
    protected array $updateRules = [
    'from_step_code' => 'required|exists:workflow_steps,code',
    'to_step_code' => 'required|exists:workflow_steps,code',
    'condition_code' => 'nullable|string|max:100',
    'condition_label' => 'nullable|string|max:180',
    'is_default' => 'nullable|boolean',
    'description' => 'nullable|string',
    ];
}
