<?php

namespace App\Http\Controllers\Admin;

use App\Models\AccountsReview;
use Illuminate\Http\Request;

class AccountsReviewController extends AdminCrudController
{
    protected string $modelClass = AccountsReview::class;
    protected string $viewPath = 'Admin.accounts_reviews';
    protected array $with = ['quoteRequest', 'costEstimation', 'reviewer', 'paymentTerm'];
    protected array $searchable = ['financial_notes', 'correction_required'];
    protected array $filterable = ['quote_request_id', 'cost_estimation_id', 'reviewed_by', 'decision', 'payment_terms_id', 'credit_limit_checked'];
    protected array $storeRules = [
        'quote_request_id' => 'required|exists:quote_requests,id',
        'cost_estimation_id' => 'nullable|exists:cost_estimations,id',
        'reviewed_by' => 'nullable|exists:users,id',
        'decision' => 'nullable|in:pending,approved,returned_for_correction,rejected',
        'credit_limit_checked' => 'nullable|boolean',
        'payment_terms_id' => 'nullable|exists:payment_terms,id',
        'financial_notes' => 'nullable|string',
        'correction_required' => 'nullable|string',
        'reviewed_at' => 'nullable|date',
    ];
    protected array $updateRules = [
        'quote_request_id' => 'nullable|exists:quote_requests,id',
        'cost_estimation_id' => 'nullable|exists:cost_estimations,id',
        'reviewed_by' => 'nullable|exists:users,id',
        'decision' => 'nullable|in:pending,approved,returned_for_correction,rejected',
        'credit_limit_checked' => 'nullable|boolean',
        'payment_terms_id' => 'nullable|exists:payment_terms,id',
        'financial_notes' => 'nullable|string',
        'correction_required' => 'nullable|string',
        'reviewed_at' => 'nullable|date',
    ];

    public function decide(Request $request, AccountsReview $accountsReview)
    {
        $data = $request->validate([
            'decision' => 'required|in:approved,returned_for_correction,rejected',
            'financial_notes' => 'nullable|string',
            'correction_required' => 'nullable|string',
            'payment_terms_id' => 'nullable|exists:payment_terms,id',
            'credit_limit_checked' => 'nullable|boolean',
        ]);

        $data['reviewed_by'] = auth()->id() ?: $accountsReview->reviewed_by;
        $data['reviewed_at'] = now();
        $accountsReview->update($data);

        $accountsReview->quoteRequest?->update([
            'status' => $data['decision'] === 'approved' ? 'management_review' : 'estimation_in_progress',
        ]);

        return response()->json(['success' => true, 'message' => 'تم تسجيل قرار الحسابات', 'data' => $accountsReview->fresh()]);
    }
}
