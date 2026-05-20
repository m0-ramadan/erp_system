<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductionPlan;
use Illuminate\Http\Request;

class ProductionPlanController extends AdminCrudController
{
    protected string $modelClass = ProductionPlan::class;
    protected string $viewPath = 'Admin.production_plans';
    protected array $with = ['jobTicket', 'planner'];
    protected array $searchable = ['feasibility_notes', 'plan_notes'];
    protected array $filterable = ['job_ticket_id', 'planned_by', 'feasibility_status', 'plan_status'];
    protected array $storeRules = [
        'job_ticket_id' => 'required|exists:job_tickets,id',
        'planned_by' => 'nullable|exists:users,id',
        'feasibility_status' => 'nullable|in:pending,feasible,not_feasible,feasible_with_notes',
        'feasibility_notes' => 'nullable|string',
        'plan_status' => 'nullable|in:draft,approved,released,in_progress,completed,cancelled',
        'planned_start_date' => 'nullable|date',
        'planned_end_date' => 'nullable|date',
        'actual_start_at' => 'nullable|date',
        'actual_end_at' => 'nullable|date',
        'plan_notes' => 'nullable|string',
    ];
    protected array $updateRules = [
        'job_ticket_id' => 'nullable|exists:job_tickets,id',
        'planned_by' => 'nullable|exists:users,id',
        'feasibility_status' => 'nullable|in:pending,feasible,not_feasible,feasible_with_notes',
        'feasibility_notes' => 'nullable|string',
        'plan_status' => 'nullable|in:draft,approved,released,in_progress,completed,cancelled',
        'planned_start_date' => 'nullable|date',
        'planned_end_date' => 'nullable|date',
        'actual_start_at' => 'nullable|date',
        'actual_end_at' => 'nullable|date',
        'plan_notes' => 'nullable|string',
    ];

    public function approve(Request $request, ProductionPlan $productionPlan)
    {
        $productionPlan->update(['plan_status' => 'approved']);
        $productionPlan->jobTicket?->update(['status' => 'production_planning']);
        return response()->json(['success' => true, 'message' => 'تم اعتماد خطة الإنتاج', 'data' => $productionPlan]);
    }

    public function release(Request $request, ProductionPlan $productionPlan)
    {
        $productionPlan->update(['plan_status' => 'released', 'actual_start_at' => now()]);
        $productionPlan->jobTicket?->update(['status' => 'released_to_production']);
        $productionPlan->jobTicket?->salesOrder?->update(['status' => 'in_production']);
        return response()->json(['success' => true, 'message' => 'تم إصدار أمر الإنتاج', 'data' => $productionPlan]);
    }

    public function complete(Request $request, ProductionPlan $productionPlan)
    {
        $productionPlan->update(['plan_status' => 'completed', 'actual_end_at' => now()]);
        $productionPlan->jobTicket?->update(['status' => 'quality_check']);
        $productionPlan->jobTicket?->salesOrder?->update(['status' => 'quality_check']);
        return response()->json(['success' => true, 'message' => 'تم إنهاء الإنتاج وإرساله للفحص', 'data' => $productionPlan]);
    }
}
