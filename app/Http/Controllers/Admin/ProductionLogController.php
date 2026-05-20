<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProductionLogController extends AdminCrudController
{
    protected string $modelClass = ProductionLog::class;
    protected string $viewPath = 'Admin.production_logs';
    protected array $with = ['jobTicket', 'productionPlan', 'logger'];
    protected array $searchable = ['description'];
    protected array $filterable = ['job_ticket_id', 'production_plan_id', 'logged_by', 'log_type'];
    protected array $storeRules = [
    'job_ticket_id' => 'required|exists:job_tickets,id',
    'production_plan_id' => 'nullable|exists:production_plans,id',
    'logged_by' => 'nullable|exists:users,id',
    'log_type' => 'nullable|in:progress,delay,issue,material,labor,machine,note',
    'progress_percent' => 'nullable|numeric|min:0|max:100',
    'description' => 'required|string',
    'logged_at' => 'nullable|date',
    ];
    protected array $updateRules = [
    'job_ticket_id' => 'required|exists:job_tickets,id',
    'production_plan_id' => 'nullable|exists:production_plans,id',
    'logged_by' => 'nullable|exists:users,id',
    'log_type' => 'nullable|in:progress,delay,issue,material,labor,machine,note',
    'progress_percent' => 'nullable|numeric|min:0|max:100',
    'description' => 'required|string',
    'logged_at' => 'nullable|date',
    ];
}
