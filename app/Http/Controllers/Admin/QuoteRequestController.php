<?php

namespace App\Http\Controllers\Admin;

use App\Models\QuoteRequest;
use App\Services\NumberGeneratorService;
use App\Services\WorkflowService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuoteRequestController extends AdminCrudController
{
    protected string $modelClass = QuoteRequest::class;
    protected string $viewPath = 'Admin.quote_requests';
    protected array $with = ['customer', 'contact', 'salesRep', 'salesCoordinator', 'estimationOfficer', 'currency', 'items', 'files'];
    protected array $withCount = ['items', 'files', 'clarifications', 'quotations'];
    protected array $searchable = ['request_no', 'title', 'project_name', 'customer_requirements'];
    protected array $filterable = ['request_source', 'customer_id', 'sales_rep_id', 'sales_coordinator_id', 'assigned_estimation_user_id', 'priority', 'currency_id', 'status', 'completeness_status'];
    protected array $storeRules = [
        'request_no' => 'nullable|string|max:80|unique:quote_requests,request_no',
        'request_source' => 'required|in:sales_rep,sales_coordinator,customer_portal,phone,email,walk_in,other',
        'customer_id' => 'nullable|exists:customers,id',
        'contact_id' => 'nullable|exists:customer_contacts,id',
        'created_by' => 'nullable|exists:users,id',
        'sales_rep_id' => 'nullable|exists:users,id',
        'sales_coordinator_id' => 'nullable|exists:users,id',
        'assigned_estimation_user_id' => 'nullable|exists:users,id',
        'title' => 'nullable|string|max:255',
        'project_name' => 'nullable|string|max:255',
        'priority' => 'nullable|in:low,normal,high,urgent',
        'requested_delivery_date' => 'nullable|date',
        'currency_id' => 'nullable|exists:currencies,id',
        'status' => 'nullable|in:draft,submitted,in_review,clarification_requested,estimation_in_progress,design_review,accounts_review,management_review,quotation_generated,sent_to_customer,revision_requested,accepted,rejected,cancelled,closed',
        'completeness_status' => 'nullable|in:unchecked,complete,incomplete',
        'customer_requirements' => 'nullable|string',
        'internal_notes' => 'nullable|string',
    ];
    protected array $updateRules = [
        'request_no' => 'nullable|string|max:80',
        'request_source' => 'nullable|in:sales_rep,sales_coordinator,customer_portal,phone,email,walk_in,other',
        'customer_id' => 'nullable|exists:customers,id',
        'contact_id' => 'nullable|exists:customer_contacts,id',
        'created_by' => 'nullable|exists:users,id',
        'sales_rep_id' => 'nullable|exists:users,id',
        'sales_coordinator_id' => 'nullable|exists:users,id',
        'assigned_estimation_user_id' => 'nullable|exists:users,id',
        'title' => 'nullable|string|max:255',
        'project_name' => 'nullable|string|max:255',
        'priority' => 'nullable|in:low,normal,high,urgent',
        'requested_delivery_date' => 'nullable|date',
        'currency_id' => 'nullable|exists:currencies,id',
        'status' => 'nullable|in:draft,submitted,in_review,clarification_requested,estimation_in_progress,design_review,accounts_review,management_review,quotation_generated,sent_to_customer,revision_requested,accepted,rejected,cancelled,closed',
        'completeness_status' => 'nullable|in:unchecked,complete,incomplete',
        'customer_requirements' => 'nullable|string',
        'internal_notes' => 'nullable|string',
    ];

    protected function beforeStore(array $data, Request $request): array
    {
        if (empty($data['request_no'])) {
            $data['request_no'] = app(NumberGeneratorService::class)->generate(QuoteRequest::class, 'request_no', 'QR');
        }

        $data['created_by'] = $data['created_by'] ?? auth()->id();
        $data['status'] = $data['status'] ?? 'draft';

        return $data;
    }

    protected function afterStore(Model $item, Request $request): void
    {
        if ($request->boolean('submit_now')) {
            app(WorkflowService::class)->startQuoteWorkflow($item, auth()->id());
            $item->update(['status' => 'submitted', 'submitted_at' => now()]);
        }
    }

    public function submit(Request $request, QuoteRequest $quoteRequest)
    {
        DB::transaction(function () use ($quoteRequest) {
            $quoteRequest->update([
                'status' => 'submitted',
                'submitted_at' => now(),
            ]);

            if (! $quoteRequest->workflowInstances()->where('status', 'active')->exists()) {
                app(WorkflowService::class)->startQuoteWorkflow($quoteRequest, auth()->id());
            }
        });

        return response()->json(['success' => true, 'message' => 'تم إرسال طلب عرض السعر بنجاح']);
    }

    public function assignSalesRep(Request $request, QuoteRequest $quoteRequest)
    {
        $data = $request->validate([
            'sales_rep_id' => 'required|exists:users,id',
        ]);

        $quoteRequest->update($data);

        return response()->json(['success' => true, 'message' => 'تم تعيين مسؤول المبيعات بنجاح', 'data' => $quoteRequest->fresh('salesRep')]);
    }

    public function completeness(Request $request, QuoteRequest $quoteRequest)
    {
        $data = $request->validate([
            'completeness_status' => 'required|in:complete,incomplete,unchecked',
            'internal_notes' => 'nullable|string',
        ]);

        $quoteRequest->update($data + [
            'status' => $data['completeness_status'] === 'complete' ? 'estimation_in_progress' : 'clarification_requested',
        ]);

        return response()->json(['success' => true, 'message' => 'تم تحديث حالة اكتمال الطلب', 'data' => $quoteRequest]);
    }
}
