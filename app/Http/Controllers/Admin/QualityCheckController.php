<?php

namespace App\Http\Controllers\Admin;

use App\Models\QualityCheck;
use Illuminate\Http\Request;

class QualityCheckController extends AdminCrudController
{
    protected string $modelClass = QualityCheck::class;
    protected string $viewPath = 'Admin.quality_checks';
    protected array $with = ['jobTicket', 'checker'];
    protected array $searchable = ['defects_found', 'corrective_action'];
    protected array $filterable = ['job_ticket_id', 'checked_by', 'result'];
    protected array $storeRules = [
        'job_ticket_id' => 'required|exists:job_tickets,id',
        'checked_by' => 'nullable|exists:users,id',
        'result' => 'nullable|in:pending,passed,failed,passed_with_notes',
        'checklist' => 'nullable|array',
        'defects_found' => 'nullable|string',
        'corrective_action' => 'nullable|string',
        'checked_at' => 'nullable|date',
    ];
    protected array $updateRules = [
        'job_ticket_id' => 'nullable|exists:job_tickets,id',
        'checked_by' => 'nullable|exists:users,id',
        'result' => 'nullable|in:pending,passed,failed,passed_with_notes',
        'checklist' => 'nullable|array',
        'defects_found' => 'nullable|string',
        'corrective_action' => 'nullable|string',
        'checked_at' => 'nullable|date',
    ];

    public function decide(Request $request, QualityCheck $qualityCheck)
    {
        $data = $request->validate([
            'result' => 'required|in:passed,failed,passed_with_notes',
            'defects_found' => 'nullable|string',
            'corrective_action' => 'nullable|string',
            'checklist' => 'nullable|array',
        ]);

        $data['checked_by'] = auth()->id() ?: $qualityCheck->checked_by;
        $data['checked_at'] = now();
        $qualityCheck->update($data);

        $qualityCheck->jobTicket?->update(['status' => in_array($data['result'], ['passed', 'passed_with_notes']) ? 'ready_for_dispatch' : 'failed']);
        $qualityCheck->jobTicket?->salesOrder?->update(['status' => in_array($data['result'], ['passed', 'passed_with_notes']) ? 'ready_for_dispatch' : 'in_production']);

        return response()->json(['success' => true, 'message' => 'تم تسجيل نتيجة الفحص', 'data' => $qualityCheck->fresh()]);
    }
}
