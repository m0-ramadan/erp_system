<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkflowInstance;
use App\Models\WorkflowTask;
use App\Services\WorkflowService;
use Illuminate\Http\Request;

class WorkflowController extends Controller
{
    public function __construct(private WorkflowService $workflowService)
    {
    }

    public function openTasks(Request $request)
    {
        $query = WorkflowTask::with(['instance', 'step', 'assignedUser'])
            ->whereIn('task_status', ['open', 'in_progress']);

        if ($request->filled('assigned_user_id')) {
            $query->where('assigned_user_id', $request->assigned_user_id);
        }

        if ($request->filled('assigned_role_code')) {
            $query->where('assigned_role_code', $request->assigned_role_code);
        }

        return response()->json([
            'success' => true,
            'data' => $query->latest()->paginate($request->get('per_page', 15)),
        ]);
    }

    public function move(Request $request, WorkflowInstance $workflowInstance)
    {
        $data = $request->validate([
            'condition_code' => 'nullable|string|max:100',
            'comments' => 'nullable|string',
        ]);

        $instance = $this->workflowService->move(
            $workflowInstance,
            $data['condition_code'] ?? null,
            auth()->id(),
            $data['comments'] ?? null
        );

        return response()->json([
            'success' => true,
            'message' => 'تم نقل مرحلة العمل بنجاح',
            'data' => $instance,
        ]);
    }
}
