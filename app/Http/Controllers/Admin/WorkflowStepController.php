<?php

namespace App\Http\Controllers\Admin;

use App\Models\WorkflowStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WorkflowStepController extends AdminCrudController
{
    protected string $modelClass = WorkflowStep::class;
    protected string $viewPath = 'Admin.workflow_steps';
    protected array $with = [];
    protected array $searchable = ['code', 'name', 'lane', 'role_code'];
    protected array $filterable = ['lane', 'role_code', 'step_type', 'is_terminal'];
    protected array $storeRules = [
    'code' => 'required|string|max:100|unique:workflow_steps,code',
    'name' => 'required|string|max:180',
    'lane' => 'required|string|max:100',
    'role_code' => 'nullable|string|max:80',
    'step_type' => 'required|in:start,task,gateway,system,end',
    'sort_order' => 'nullable|integer',
    'is_terminal' => 'nullable|boolean',
    'description' => 'nullable|string',
    ];
    protected array $updateRules = [
    'code' => 'required|string|max:100',
    'name' => 'required|string|max:180',
    'lane' => 'required|string|max:100',
    'role_code' => 'nullable|string|max:80',
    'step_type' => 'required|in:start,task,gateway,system,end',
    'sort_order' => 'nullable|integer',
    'is_terminal' => 'nullable|boolean',
    'description' => 'nullable|string',
    ];
}
