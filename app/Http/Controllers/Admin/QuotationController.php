<?php

namespace App\Http\Controllers\Admin;

use App\Models\CustomerResponse;
use App\Models\Quotation;
use App\Models\QuotationVersion;
use App\Services\NumberGeneratorService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuotationController extends AdminCrudController
{
    protected string $modelClass = Quotation::class;
    protected string $viewPath = 'Admin.quotations';
    protected array $with = ['quoteRequest', 'customer', 'salesRep', 'currency', 'paymentTerm', 'versions', 'currentVersion'];
    protected array $withCount = ['versions', 'customerResponses', 'salesOrders'];
    protected array $searchable = ['quotation_no', 'notes'];
    protected array $filterable = ['quote_request_id', 'customer_id', 'sales_rep_id', 'currency_id', 'payment_terms_id', 'status'];
    protected array $storeRules = [
        'quote_request_id' => 'required|exists:quote_requests,id',
        'quotation_no' => 'nullable|string|max:80|unique:quotations,quotation_no',
        'current_version_no' => 'nullable|integer|min:1',
        'customer_id' => 'nullable|exists:customers,id',
        'sales_rep_id' => 'nullable|exists:users,id',
        'currency_id' => 'nullable|exists:currencies,id',
        'payment_terms_id' => 'nullable|exists:payment_terms,id',
        'quotation_date' => 'required|date',
        'valid_until' => 'nullable|date',
        'subtotal' => 'nullable|numeric|min:0',
        'discount_amount' => 'nullable|numeric|min:0',
        'tax_amount' => 'nullable|numeric|min:0',
        'total_amount' => 'nullable|numeric|min:0',
        'status' => 'nullable|in:draft,pending_design,pending_accounts,pending_management,approved,sent,revision_requested,accepted,rejected,expired,cancelled,closed',
        'pdf_path' => 'nullable|string|max:500',
        'notes' => 'nullable|string',
        'created_by' => 'nullable|exists:users,id',
    ];
    protected array $updateRules = [
        'quote_request_id' => 'nullable|exists:quote_requests,id',
        'quotation_no' => 'nullable|string|max:80',
        'current_version_no' => 'nullable|integer|min:1',
        'customer_id' => 'nullable|exists:customers,id',
        'sales_rep_id' => 'nullable|exists:users,id',
        'currency_id' => 'nullable|exists:currencies,id',
        'payment_terms_id' => 'nullable|exists:payment_terms,id',
        'quotation_date' => 'nullable|date',
        'valid_until' => 'nullable|date',
        'subtotal' => 'nullable|numeric|min:0',
        'discount_amount' => 'nullable|numeric|min:0',
        'tax_amount' => 'nullable|numeric|min:0',
        'total_amount' => 'nullable|numeric|min:0',
        'status' => 'nullable|in:draft,pending_design,pending_accounts,pending_management,approved,sent,revision_requested,accepted,rejected,expired,cancelled,closed',
        'pdf_path' => 'nullable|string|max:500',
        'notes' => 'nullable|string',
        'created_by' => 'nullable|exists:users,id',
    ];

    protected function beforeStore(array $data, Request $request): array
    {
        if (empty($data['quotation_no'])) {
            $data['quotation_no'] = app(NumberGeneratorService::class)->generate(Quotation::class, 'quotation_no', 'QTN');
        }

        $data['created_by'] = $data['created_by'] ?? auth()->id();
        $data['status'] = $data['status'] ?? 'draft';

        if (empty($data['total_amount'])) {
            $data['total_amount'] = ($data['subtotal'] ?? 0) - ($data['discount_amount'] ?? 0) + ($data['tax_amount'] ?? 0);
        }

        return $data;
    }

    protected function afterStore(Model $item, Request $request): void
    {
        QuotationVersion::create([
            'quotation_id' => $item->id,
            'version_no' => 1,
            'created_by' => auth()->id(),
            'version_reason' => 'initial',
            'subtotal' => $item->subtotal,
            'discount_amount' => $item->discount_amount,
            'tax_amount' => $item->tax_amount,
            'total_amount' => $item->total_amount,
            'pdf_path' => $item->pdf_path,
            'notes' => $item->notes,
        ]);
    }

    public function sendToCustomer(Request $request, Quotation $quotation)
    {
        $quotation->update(['status' => 'sent', 'sent_at' => now()]);
        $quotation->quoteRequest?->update(['status' => 'sent_to_customer']);

        return response()->json(['success' => true, 'message' => 'تم إرسال عرض السعر للعميل', 'data' => $quotation->fresh()]);
    }

    public function recordCustomerResponse(Request $request, Quotation $quotation)
    {
        $data = $request->validate([
            'response' => 'required|in:accepted,rejected,revision_requested,no_response',
            'contact_id' => 'nullable|exists:customer_contacts,id',
            'response_notes' => 'nullable|string',
            'revision_details' => 'nullable|string',
            'rejection_reason' => 'nullable|string',
        ]);

        DB::transaction(function () use ($quotation, $data) {
            CustomerResponse::create([
                'quotation_id' => $quotation->id,
                'quotation_version_id' => $quotation->currentVersion?->id,
                'customer_id' => $quotation->customer_id,
                'contact_id' => $data['contact_id'] ?? null,
                'response' => $data['response'],
                'response_notes' => $data['response_notes'] ?? null,
                'revision_details' => $data['revision_details'] ?? null,
                'rejection_reason' => $data['rejection_reason'] ?? null,
                'responded_at' => now(),
                'recorded_by' => auth()->id(),
            ]);

            $status = match ($data['response']) {
                'accepted' => 'accepted',
                'rejected' => 'rejected',
                'revision_requested' => 'revision_requested',
                default => 'sent',
            };

            $quotation->update([
                'status' => $status,
                'accepted_at' => $data['response'] === 'accepted' ? now() : $quotation->accepted_at,
                'rejected_at' => $data['response'] === 'rejected' ? now() : $quotation->rejected_at,
            ]);

            $quotation->quoteRequest?->update(['status' => $status]);
        });

        return response()->json(['success' => true, 'message' => 'تم تسجيل رد العميل', 'data' => $quotation->fresh(['customerResponses'])]);
    }
}
