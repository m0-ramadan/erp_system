<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use App\Services\NumberGeneratorService;
use Illuminate\Http\Request;

class InvoiceController extends AdminCrudController
{
    protected string $modelClass = Invoice::class;
    protected string $viewPath = 'Admin.invoices';
    protected array $with = ['salesOrder', 'customer', 'creator', 'items'];
    protected array $withCount = ['items'];
    protected array $searchable = ['invoice_no', 'pdf_path'];
    protected array $filterable = ['sales_order_id', 'customer_id', 'status', 'created_by'];
    protected array $storeRules = [
        'sales_order_id' => 'required|exists:sales_orders,id',
        'customer_id' => 'nullable|exists:customers,id',
        'invoice_no' => 'nullable|string|max:80|unique:invoices,invoice_no',
        'invoice_date' => 'required|date',
        'due_date' => 'nullable|date',
        'status' => 'nullable|in:draft,issued,partially_paid,paid,overdue,cancelled',
        'subtotal' => 'nullable|numeric|min:0',
        'discount_amount' => 'nullable|numeric|min:0',
        'tax_amount' => 'nullable|numeric|min:0',
        'total_amount' => 'nullable|numeric|min:0',
        'paid_amount' => 'nullable|numeric|min:0',
        'pdf_path' => 'nullable|string|max:500',
        'created_by' => 'nullable|exists:users,id',
        'issued_at' => 'nullable|date',
    ];
    protected array $updateRules = [
        'sales_order_id' => 'nullable|exists:sales_orders,id',
        'customer_id' => 'nullable|exists:customers,id',
        'invoice_no' => 'nullable|string|max:80',
        'invoice_date' => 'nullable|date',
        'due_date' => 'nullable|date',
        'status' => 'nullable|in:draft,issued,partially_paid,paid,overdue,cancelled',
        'subtotal' => 'nullable|numeric|min:0',
        'discount_amount' => 'nullable|numeric|min:0',
        'tax_amount' => 'nullable|numeric|min:0',
        'total_amount' => 'nullable|numeric|min:0',
        'paid_amount' => 'nullable|numeric|min:0',
        'pdf_path' => 'nullable|string|max:500',
        'created_by' => 'nullable|exists:users,id',
        'issued_at' => 'nullable|date',
    ];

    protected function beforeStore(array $data, Request $request): array
    {
        if (empty($data['invoice_no'])) {
            $data['invoice_no'] = app(NumberGeneratorService::class)->generate(Invoice::class, 'invoice_no', 'INV');
        }

        $data['created_by'] = $data['created_by'] ?? auth()->id();
        $data['total_amount'] = $data['total_amount'] ?? (($data['subtotal'] ?? 0) - ($data['discount_amount'] ?? 0) + ($data['tax_amount'] ?? 0));
        return $data;
    }

    public function issue(Request $request, Invoice $invoice)
    {
        $invoice->update(['status' => 'issued', 'issued_at' => now()]);
        $invoice->salesOrder?->update(['status' => 'invoiced']);
        return response()->json(['success' => true, 'message' => 'تم إصدار الفاتورة', 'data' => $invoice]);
    }

    public function markPaid(Request $request, Invoice $invoice)
    {
        $data = $request->validate(['paid_amount' => 'nullable|numeric|min:0']);
        $paid = $data['paid_amount'] ?? $invoice->total_amount;
        $invoice->update(['paid_amount' => $paid, 'status' => $paid >= $invoice->total_amount ? 'paid' : 'partially_paid']);
        return response()->json(['success' => true, 'message' => 'تم تحديث حالة الدفع', 'data' => $invoice]);
    }
}
