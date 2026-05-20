<?php

namespace App\Http\Controllers\Admin;

use App\Models\DesignReview;
use Illuminate\Http\Request;

class DesignReviewController extends AdminCrudController
{
    protected string $modelClass = DesignReview::class;
    protected string $viewPath = 'Admin.design_reviews';
    protected array $with = ['quoteRequest', 'reviewer'];
    protected array $searchable = ['design_notes', 'rejection_reason'];
    protected array $filterable = ['quote_request_id', 'reviewed_by', 'feasibility_status', 'decision'];
    protected array $storeRules = [
        'quote_request_id' => 'required|exists:quote_requests,id',
        'reviewed_by' => 'nullable|exists:users,id',
        'feasibility_status' => 'nullable|in:pending,feasible,feasible_with_notes,not_feasible',
        'decision' => 'nullable|in:pending,approved,approved_with_notes,rejected',
        'design_notes' => 'nullable|string',
        'rejection_reason' => 'nullable|string',
        'reviewed_at' => 'nullable|date',
    ];
    protected array $updateRules = [
        'quote_request_id' => 'nullable|exists:quote_requests,id',
        'reviewed_by' => 'nullable|exists:users,id',
        'feasibility_status' => 'nullable|in:pending,feasible,feasible_with_notes,not_feasible',
        'decision' => 'nullable|in:pending,approved,approved_with_notes,rejected',
        'design_notes' => 'nullable|string',
        'rejection_reason' => 'nullable|string',
        'reviewed_at' => 'nullable|date',
    ];

    public function decide(Request $request, DesignReview $designReview)
    {
        $data = $request->validate([
            'decision' => 'required|in:approved,approved_with_notes,rejected',
            'design_notes' => 'nullable|string',
            'rejection_reason' => 'nullable|string',
        ]);

        $data['reviewed_by'] = auth()->id() ?: $designReview->reviewed_by;
        $data['reviewed_at'] = now();
        $data['feasibility_status'] = match ($data['decision']) {
            'approved' => 'feasible',
            'approved_with_notes' => 'feasible_with_notes',
            default => 'not_feasible',
        };

        $designReview->update($data);
        $designReview->quoteRequest?->update([
            'status' => $data['decision'] === 'rejected' ? 'estimation_in_progress' : 'accounts_review',
        ]);

        return response()->json(['success' => true, 'message' => 'تم تسجيل قرار التصميم', 'data' => $designReview->fresh()]);
    }
}
