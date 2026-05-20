<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dispatch;
use App\Services\NumberGeneratorService;
use Illuminate\Http\Request;

class DispatchController extends AdminCrudController
{
    protected string $modelClass = Dispatch::class;
    protected string $viewPath = 'Admin.dispatches';
    protected array $with = ['salesOrder', 'jobTicket', 'dispatcher'];
    protected array $withCount = ['deliveries'];
    protected array $searchable = ['dispatch_no', 'carrier_name', 'tracking_no', 'dispatch_address'];
    protected array $filterable = ['sales_order_id', 'job_ticket_id', 'status', 'dispatched_by'];
    protected array $storeRules = [
        'sales_order_id' => 'required|exists:sales_orders,id',
        'job_ticket_id' => 'nullable|exists:job_tickets,id',
        'dispatch_no' => 'nullable|string|max:80|unique:dispatches,dispatch_no',
        'status' => 'nullable|in:pending,dispatched,returned,cancelled',
        'carrier_name' => 'nullable|string|max:180',
        'tracking_no' => 'nullable|string|max:180',
        'dispatch_address' => 'nullable|string',
        'dispatched_by' => 'nullable|exists:users,id',
        'dispatched_at' => 'nullable|date',
        'notes' => 'nullable|string',
    ];
    protected array $updateRules = [
        'sales_order_id' => 'nullable|exists:sales_orders,id',
        'job_ticket_id' => 'nullable|exists:job_tickets,id',
        'dispatch_no' => 'nullable|string|max:80',
        'status' => 'nullable|in:pending,dispatched,returned,cancelled',
        'carrier_name' => 'nullable|string|max:180',
        'tracking_no' => 'nullable|string|max:180',
        'dispatch_address' => 'nullable|string',
        'dispatched_by' => 'nullable|exists:users,id',
        'dispatched_at' => 'nullable|date',
        'notes' => 'nullable|string',
    ];

    protected function beforeStore(array $data, Request $request): array
    {
        if (empty($data['dispatch_no'])) {
            $data['dispatch_no'] = app(NumberGeneratorService::class)->generate(Dispatch::class, 'dispatch_no', 'DSP');
        }
        return $data;
    }

    public function markDispatched(Request $request, Dispatch $dispatch)
    {
        $dispatch->update(['status' => 'dispatched', 'dispatched_by' => auth()->id() ?: $dispatch->dispatched_by, 'dispatched_at' => now()]);
        $dispatch->salesOrder?->update(['status' => 'dispatched']);
        $dispatch->jobTicket?->update(['status' => 'dispatched']);
        return response()->json(['success' => true, 'message' => 'تم شحن الطلب', 'data' => $dispatch]);
    }
}
