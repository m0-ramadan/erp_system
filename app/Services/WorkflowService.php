<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\QuoteRequest;
use App\Models\WorkflowHistory;
use App\Models\WorkflowInstance;
use App\Models\WorkflowStep;
use App\Models\WorkflowTask;
use App\Models\WorkflowTransition;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class WorkflowService
{
    public function startQuoteWorkflow(QuoteRequest $quoteRequest, ?int $startedBy = null): WorkflowInstance
    {
        return DB::transaction(function () use ($quoteRequest, $startedBy) {
            $firstStep = $quoteRequest->request_source === 'sales_coordinator'
                ? 'LOGIN_SALES_COORDINATOR'
                : 'LOGIN_SALES_REP';

            $instance = WorkflowInstance::create([
                'entity_type' => 'quote_request',
                'entity_id' => $quoteRequest->id,
                'current_step_code' => $firstStep,
                'status' => 'active',
                'started_by' => $startedBy,
                'started_at' => now(),
            ]);

            $this->createOpenTask($instance, $firstStep);

            WorkflowHistory::create([
                'workflow_instance_id' => $instance->id,
                'from_step_code' => 'START',
                'to_step_code' => $firstStep,
                'action_code' => 'workflow_started',
                'action_label' => 'Workflow Started',
                'acted_by' => $startedBy,
                'acted_at' => now(),
            ]);

            $this->logAudit('quote_request', $quoteRequest->id, 'workflow_started', null, [
                'workflow_instance_id' => $instance->id,
                'current_step_code' => $firstStep,
            ], $startedBy);

            return $instance;
        });
    }

    public function move(WorkflowInstance $instance, ?string $conditionCode = null, ?int $actedBy = null, ?string $comments = null): WorkflowInstance
    {
        return DB::transaction(function () use ($instance, $conditionCode, $actedBy, $comments) {
            $instance->refresh();
            $fromStep = $instance->current_step_code;

            $transition = WorkflowTransition::query()
                ->where('from_step_code', $fromStep)
                ->where(function ($query) use ($conditionCode) {
                    if ($conditionCode !== null) {
                        $query->where('condition_code', $conditionCode);
                    } else {
                        $query->where('is_default', true);
                    }
                })
                ->orderByDesc('is_default')
                ->first();

            if (! $transition) {
                throw new RuntimeException('No matching workflow transition found.');
            }

            WorkflowTask::query()
                ->where('workflow_instance_id', $instance->id)
                ->where('step_code', $fromStep)
                ->whereIn('task_status', ['open', 'in_progress'])
                ->update([
                    'task_status' => 'completed',
                    'completed_at' => now(),
                    'result_code' => $conditionCode,
                    'result_notes' => $comments,
                    'updated_at' => now(),
                ]);

            $instance->update([
                'current_step_code' => $transition->to_step_code,
                'status' => $transition->to_step_code === 'END' ? 'completed' : $instance->status,
                'completed_at' => $transition->to_step_code === 'END' ? now() : $instance->completed_at,
            ]);

            if ($transition->to_step_code !== 'END') {
                $this->createOpenTask($instance, $transition->to_step_code);
            }

            WorkflowHistory::create([
                'workflow_instance_id' => $instance->id,
                'from_step_code' => $fromStep,
                'to_step_code' => $transition->to_step_code,
                'transition_id' => $transition->id,
                'action_code' => $conditionCode ?: 'next',
                'action_label' => $transition->condition_label ?: 'Next Step',
                'comments' => $comments,
                'acted_by' => $actedBy,
                'acted_at' => now(),
            ]);

            $this->logAudit($instance->entity_type, $instance->entity_id, 'workflow_moved', [
                'from_step_code' => $fromStep,
            ], [
                'to_step_code' => $transition->to_step_code,
                'condition_code' => $conditionCode,
            ], $actedBy);

            return $instance->fresh(['currentStep', 'openTasks']);
        });
    }

    public function createOpenTask(WorkflowInstance $instance, string $stepCode): WorkflowTask
    {
        $step = WorkflowStep::where('code', $stepCode)->first();

        return WorkflowTask::create([
            'workflow_instance_id' => $instance->id,
            'step_code' => $stepCode,
            'assigned_role_code' => $step?->role_code,
            'task_status' => 'open',
        ]);
    }

    public function logAudit(string $entityType, ?int $entityId, string $action, ?array $oldValues = null, ?array $newValues = null, ?int $performedBy = null): AuditLog
    {
        return AuditLog::create([
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'action' => $action,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => request()?->ip(),
            'user_agent' => request()?->userAgent(),
            'performed_by' => $performedBy,
            'performed_at' => now(),
        ]);
    }
}
