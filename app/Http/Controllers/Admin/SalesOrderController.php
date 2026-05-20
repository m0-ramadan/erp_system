<?php

namespace App\Http\Controllers\Admin;

use App\Models\JobTicket;
use App\Models\SalesOrder;
use App\Services\NumberGeneratorService;
use Illuminate\Http\Request;

class SalesOrderController extends AdminCrudController
{
    protected string $modelClass = SalesOrder::class;
    protected string $viewPath = 'Admin.sales_orders';
    protected array $with = ['quotation', 'quotationVersion', 'customer', 'salesRep', 'jobTickets', 'invoices'];
    protected array $withCount = ['jobTickets', 'dispatches', 'deliveries', 'invoices'];
    protected array $searchable = ['order_no', 'hold_reason', 'cancel_reason', 'reopened_reason'];
    protected array $filterable = ['quotation_id', 'quotation_version_id', 'customer_id', 'sales_rep_id', 'status', 'created_by'];
    protected array $storeRules = [
        'quotation_id' => 'required|exists:quotations,id',
        'quotation_version_id' => 'nullable|exists:quotation_versions,id',
        'order_no' => 'nullable|string|max:80|unique:sales_orders,order_no',
        'customer_id' => 'nullable|exists:customers,id',
        'sales_rep_id' => 'nullable|exists:users,id',
        'status' => 'nullable|in:created,on_hold,released_to_production,in_production,quality_check,ready_for_dispatch,dispatched,delivered,invoiced,closed,cancelled,reopened',
        'order_date' => 'required|date',
        'planned_delivery_date' => 'nullable|date',
        'total_amount' => 'nullable|numeric|min:0',
        'created_by' => 'nullable|exists:users,id',
    ];
    protected array $updateRules = [
        'quotation_id' => 'nullable|exists:quotations,id',
        'quotation_version_id' => 'nullable|exists:quotation_versions,id',
        'order_no' => 'nullable|string|max:80',
        'customer_id' => 'nullable|exists:customers,id',
        'sales_rep_id' => 'nullable|exists:users,id',
        'status' => 'nullable|in:created,on_hold,released_to_production,in_production,quality_check,ready_for_dispatch,dispatched,delivered,invoiced,closed,cancelled,reopened',
        'order_date' => 'nullable|date',
        'planned_delivery_date' => 'nullable|date',
        'total_amount' => 'nullable|numeric|min:0',
        'hold_reason' => 'nullable|string',
        'cancel_reason' => 'nullable|string',
        'reopened_reason' => 'nullable|string',
        'created_by' => 'nullable|exists:users,id',
    ];

    protected function beforeStore(array $data, Request $request): array
    {
        if (empty($data['order_no'])) {
            $data['order_no'] = app(NumberGeneratorService::class)->generate(SalesOrder::class, 'order_no', 'SO');
        }

        $data['created_by'] = $data['created_by'] ?? auth()->id();
        return $data;
    }

    public function createJobTicket(Request $request, SalesOrder $salesOrder)
    {
        $ticket = JobTicket::create([
            'sales_order_id' => $salesOrder->id,
            'ticket_no' => app(NumberGeneratorService::class)->generate(JobTicket::class, 'ticket_no', 'JT'),
            'status' => 'created',
            'priority' => $request->get('priority', 'normal'),
            'production_notes' => $request->get('production_notes'),
            'created_by' => auth()->id(),
        ]);

        $salesOrder->update(['status' => 'released_to_production']);

        return response()->json(['success' => true, 'message' => 'تم إنشاء أمر التشغيل', 'data' => $ticket]);
    }

    public function hold(Request $request, SalesOrder $salesOrder)
    {
        $data = $request->validate(['hold_reason' => 'required|string']);
        $salesOrder->update(['status' => 'on_hold', 'hold_reason' => $data['hold_reason'], 'held_at' => now()]);
        return response()->json(['success' => true, 'message' => 'تم إيقاف الطلب مؤقتاً', 'data' => $salesOrder]);
    }

    public function cancel(Request $request, SalesOrder $salesOrder)
    {
        $data = $request->validate(['cancel_reason' => 'required|string']);
        $salesOrder->update(['status' => 'cancelled', 'cancel_reason' => $data['cancel_reason'], 'cancelled_at' => now()]);
        return response()->json(['success' => true, 'message' => 'تم إلغاء الطلب', 'data' => $salesOrder]);
    }

    public function reopen(Request $request, SalesOrder $salesOrder)
    {
        $data = $request->validate(['reopened_reason' => 'nullable|string']);
        $salesOrder->update(['status' => 'reopened', 'reopened_reason' => $data['reopened_reason'] ?? null, 'reopened_at' => now()]);
        return response()->json(['success' => true, 'message' => 'تم إعادة فتح الطلب', 'data' => $salesOrder]);
    }

    public function close(Request $request, SalesOrder $salesOrder)
    {
        $salesOrder->update(['status' => 'closed', 'closed_at' => now()]);
        return response()->json(['success' => true, 'message' => 'تم إغلاق الطلب', 'data' => $salesOrder]);
    }
}
