<?php

namespace App\Http\Controllers\Admin;

use App\Models\Delivery;
use App\Services\NumberGeneratorService;
use Illuminate\Http\Request;

class DeliveryController extends AdminCrudController
{
    protected string $modelClass = Delivery::class;
    protected string $viewPath = 'Admin.deliveries';
    protected array $with = ['dispatch', 'salesOrder', 'confirmer'];
    protected array $searchable = ['delivery_no', 'received_by_name', 'received_by_phone', 'proof_file_path'];
    protected array $filterable = ['dispatch_id', 'sales_order_id', 'status', 'confirmed_by'];
    protected array $storeRules = [
        'dispatch_id' => 'required|exists:dispatches,id',
        'sales_order_id' => 'required|exists:sales_orders,id',
        'delivery_no' => 'nullable|string|max:80|unique:deliveries,delivery_no',
        'status' => 'nullable|in:pending,confirmed,failed,returned',
        'received_by_name' => 'nullable|string|max:180',
        'received_by_phone' => 'nullable|string|max:80',
        'proof_file_path' => 'nullable|string|max:500',
        'delivered_at' => 'nullable|date',
        'confirmed_by' => 'nullable|exists:users,id',
        'notes' => 'nullable|string',
    ];
    protected array $updateRules = [
        'dispatch_id' => 'nullable|exists:dispatches,id',
        'sales_order_id' => 'nullable|exists:sales_orders,id',
        'delivery_no' => 'nullable|string|max:80',
        'status' => 'nullable|in:pending,confirmed,failed,returned',
        'received_by_name' => 'nullable|string|max:180',
        'received_by_phone' => 'nullable|string|max:80',
        'proof_file_path' => 'nullable|string|max:500',
        'delivered_at' => 'nullable|date',
        'confirmed_by' => 'nullable|exists:users,id',
        'notes' => 'nullable|string',
    ];

    protected function beforeStore(array $data, Request $request): array
    {
        if (empty($data['delivery_no'])) {
            $data['delivery_no'] = app(NumberGeneratorService::class)->generate(Delivery::class, 'delivery_no', 'DLV');
        }
        return $data;
    }

    public function confirm(Request $request, Delivery $delivery)
    {
        $data = $request->validate([
            'received_by_name' => 'nullable|string|max:180',
            'received_by_phone' => 'nullable|string|max:80',
            'proof_file_path' => 'nullable|string|max:500',
            'notes' => 'nullable|string',
        ]);

        $delivery->update($data + ['status' => 'confirmed', 'confirmed_by' => auth()->id(), 'delivered_at' => now()]);
        $delivery->salesOrder?->update(['status' => 'delivered']);
        $delivery->dispatch?->jobTicket?->update(['status' => 'delivered']);

        return response()->json(['success' => true, 'message' => 'تم تأكيد التسليم', 'data' => $delivery]);
    }
}
