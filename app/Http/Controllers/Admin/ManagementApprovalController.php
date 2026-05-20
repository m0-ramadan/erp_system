<?php

namespace App\Http\Controllers\Admin;

use App\Models\ManagementApproval;
use Illuminate\Http\Request;

class ManagementApprovalController extends AdminCrudController
{
    protected string $modelClass = ManagementApproval::class;
    protected string $viewPath = 'Admin.management_approvals';
    protected array $with = ['quoteRequest', 'quotation', 'approver'];
    protected array $searchable = ['comments'];
    protected array $filterable = ['quote_request_id', 'quotation_id', 'approved_by', 'decision'];
    protected array $storeRules = [
        'quote_request_id' => 'required|exists:quote_requests,id',
        'quotation_id' => 'nullable|exists:quotations,id',
        'approved_by' => 'nullable|exists:users,id',
        'decision' => 'nullable|in:pending,approved,rejected,returned_to_accounts,returned_to_estimation',
        'approval_limit_amount' => 'nullable|numeric|min:0',
        'comments' => 'nullable|string',
        'decided_at' => 'nullable|date',
    ];
    protected array $updateRules = [
        'quote_request_id' => 'nullable|exists:quote_requests,id',
        'quotation_id' => 'nullable|exists:quotations,id',
        'approved_by' => 'nullable|exists:users,id',
        'decision' => 'nullable|in:pending,approved,rejected,returned_to_accounts,returned_to_estimation',
        'approval_limit_amount' => 'nullable|numeric|min:0',
        'comments' => 'nullable|string',
        'decided_at' => 'nullable|date',
    ];

    public function decide(Request $request, ManagementApproval $managementApproval)
    {
        $data = $request->validate([
            'decision' => 'required|in:approved,rejected,returned_to_accounts,returned_to_estimation',
            'comments' => 'nullable|string',
        ]);

        $data['approved_by'] = auth()->id() ?: $managementApproval->approved_by;
        $data['decided_at'] = now();
        $managementApproval->update($data);

        $managementApproval->quoteRequest?->update([
            'status' => $data['decision'] === 'approved' ? 'quotation_generated' : ($data['decision'] === 'returned_to_accounts' ? 'accounts_review' : 'estimation_in_progress'),
        ]);

        return response()->json(['success' => true, 'message' => 'تم تسجيل قرار الإدارة', 'data' => $managementApproval->fresh()]);
    }
}
