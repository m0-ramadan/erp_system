<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ReminderController extends AdminCrudController
{
    protected string $modelClass = Reminder::class;
    protected string $viewPath = 'Admin.reminders';
    protected array $with = ['creator', 'assignedUser'];
    protected array $searchable = ['message'];
    protected array $filterable = ['related_entity_type', 'related_entity_id', 'reminder_type', 'status', 'created_by', 'assigned_to'];
    protected array $storeRules = [
    'related_entity_type' => 'required|in:quote_request,quotation,sales_order,job_ticket,invoice',
    'related_entity_id' => 'required|integer|min:1',
    'reminder_type' => 'required|in:customer_follow_up,internal_task,quotation_expiry,approval_pending,production_delay,payment_due',
    'message' => 'required|string',
    'remind_at' => 'required|date',
    'sent_at' => 'nullable|date',
    'status' => 'nullable|in:scheduled,sent,cancelled,failed',
    'created_by' => 'nullable|exists:users,id',
    'assigned_to' => 'nullable|exists:users,id',
    ];
    protected array $updateRules = [
    'related_entity_type' => 'required|in:quote_request,quotation,sales_order,job_ticket,invoice',
    'related_entity_id' => 'required|integer|min:1',
    'reminder_type' => 'required|in:customer_follow_up,internal_task,quotation_expiry,approval_pending,production_delay,payment_due',
    'message' => 'required|string',
    'remind_at' => 'required|date',
    'sent_at' => 'nullable|date',
    'status' => 'nullable|in:scheduled,sent,cancelled,failed',
    'created_by' => 'nullable|exists:users,id',
    'assigned_to' => 'nullable|exists:users,id',
    ];
}
