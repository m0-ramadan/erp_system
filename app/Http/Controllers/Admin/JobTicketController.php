<?php

namespace App\Http\Controllers\Admin;

use App\Models\JobTicket;
use App\Services\NumberGeneratorService;
use Illuminate\Http\Request;

class JobTicketController extends AdminCrudController
{
    protected string $modelClass = JobTicket::class;
    protected string $viewPath = 'Admin.job_tickets';
    protected array $with = ['salesOrder', 'creator', 'latestProductionPlan'];
    protected array $withCount = ['productionPlans', 'productionLogs', 'qualityChecks', 'dispatches'];
    protected array $searchable = ['ticket_no', 'production_notes'];
    protected array $filterable = ['sales_order_id', 'status', 'priority', 'created_by'];
    protected array $storeRules = [
        'sales_order_id' => 'required|exists:sales_orders,id',
        'ticket_no' => 'nullable|string|max:80|unique:job_tickets,ticket_no',
        'status' => 'nullable|in:created,production_feasibility_review,production_planning,released_to_production,in_production,quality_check,passed,failed,ready_for_dispatch,dispatched,delivered,closed,cancelled,on_hold',
        'priority' => 'nullable|in:low,normal,high,urgent',
        'production_notes' => 'nullable|string',
        'created_by' => 'nullable|exists:users,id',
    ];
    protected array $updateRules = [
        'sales_order_id' => 'nullable|exists:sales_orders,id',
        'ticket_no' => 'nullable|string|max:80',
        'status' => 'nullable|in:created,production_feasibility_review,production_planning,released_to_production,in_production,quality_check,passed,failed,ready_for_dispatch,dispatched,delivered,closed,cancelled,on_hold',
        'priority' => 'nullable|in:low,normal,high,urgent',
        'production_notes' => 'nullable|string',
        'created_by' => 'nullable|exists:users,id',
    ];

    protected function beforeStore(array $data, Request $request): array
    {
        if (empty($data['ticket_no'])) {
            $data['ticket_no'] = app(NumberGeneratorService::class)->generate(JobTicket::class, 'ticket_no', 'JT');
        }
        $data['created_by'] = $data['created_by'] ?? auth()->id();
        return $data;
    }

    public function updateStatus(Request $request, JobTicket $jobTicket)
    {
        $data = $request->validate([
            'status' => 'required|in:created,production_feasibility_review,production_planning,released_to_production,in_production,quality_check,passed,failed,ready_for_dispatch,dispatched,delivered,closed,cancelled,on_hold',
            'production_notes' => 'nullable|string',
        ]);
        $jobTicket->update($data);
        return response()->json(['success' => true, 'message' => 'تم تحديث حالة أمر التشغيل', 'data' => $jobTicket]);
    }
}
