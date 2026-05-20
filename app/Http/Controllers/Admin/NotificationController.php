<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NotificationController extends AdminCrudController
{
    protected string $modelClass = Notification::class;
    protected string $viewPath = 'Admin.notifications';
    protected array $with = ['creator', 'recipients'];
    protected array $searchable = ['title', 'body'];
    protected array $filterable = ['related_entity_type', 'related_entity_id', 'notification_type', 'status', 'created_by'];
    protected array $storeRules = [
    'related_entity_type' => 'nullable|in:quote_request,quotation,sales_order,job_ticket,invoice,workflow_task',
    'related_entity_id' => 'nullable|integer|min:1',
    'notification_type' => 'nullable|in:system,email,sms,whatsapp,in_app',
    'title' => 'required|string|max:255',
    'body' => 'nullable|string',
    'status' => 'nullable|in:draft,queued,sent,failed,read',
    'created_by' => 'nullable|exists:users,id',
    'sent_at' => 'nullable|date',
    ];
    protected array $updateRules = [
    'related_entity_type' => 'nullable|in:quote_request,quotation,sales_order,job_ticket,invoice,workflow_task',
    'related_entity_id' => 'nullable|integer|min:1',
    'notification_type' => 'nullable|in:system,email,sms,whatsapp,in_app',
    'title' => 'required|string|max:255',
    'body' => 'nullable|string',
    'status' => 'nullable|in:draft,queued,sent,failed,read',
    'created_by' => 'nullable|exists:users,id',
    'sent_at' => 'nullable|date',
    ];
}
