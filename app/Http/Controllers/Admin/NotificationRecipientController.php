<?php

namespace App\Http\Controllers\Admin;

use App\Models\NotificationRecipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NotificationRecipientController extends AdminCrudController
{
    protected string $modelClass = NotificationRecipient::class;
    protected string $viewPath = 'Admin.notification_recipients';
    protected array $with = ['notification', 'user', 'customerContact'];
    protected array $searchable = ['recipient_email', 'recipient_phone'];
    protected array $filterable = ['notification_id', 'user_id', 'customer_contact_id', 'delivery_status'];
    protected array $storeRules = [
    'notification_id' => 'required|exists:notifications,id',
    'user_id' => 'nullable|exists:users,id',
    'customer_contact_id' => 'nullable|exists:customer_contacts,id',
    'recipient_email' => 'nullable|email|max:180',
    'recipient_phone' => 'nullable|string|max:80',
    'delivery_status' => 'nullable|in:pending,sent,failed,read',
    'delivered_at' => 'nullable|date',
    'read_at' => 'nullable|date',
    ];
    protected array $updateRules = [
    'notification_id' => 'required|exists:notifications,id',
    'user_id' => 'nullable|exists:users,id',
    'customer_contact_id' => 'nullable|exists:customer_contacts,id',
    'recipient_email' => 'nullable|email|max:180',
    'recipient_phone' => 'nullable|string|max:80',
    'delivery_status' => 'nullable|in:pending,sent,failed,read',
    'delivered_at' => 'nullable|date',
    'read_at' => 'nullable|date',
    ];
}
