<?php

namespace App\Http\Controllers\Admin;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuditLogController extends AdminCrudController
{
    protected string $modelClass = AuditLog::class;
    protected string $viewPath = 'Admin.audit_logs';
    protected array $with = ['performer'];
    protected array $searchable = ['entity_type', 'action', 'ip_address'];
    protected array $filterable = ['entity_type', 'entity_id', 'action', 'performed_by'];
    protected array $storeRules = [
    'entity_type' => 'required|string|max:100',
    'entity_id' => 'nullable|integer|min:1',
    'action' => 'required|string|max:120',
    'old_values' => 'nullable|array',
    'new_values' => 'nullable|array',
    'ip_address' => 'nullable|string|max:45',
    'user_agent' => 'nullable|string|max:500',
    'performed_by' => 'nullable|exists:users,id',
    'performed_at' => 'nullable|date',
    ];
    protected array $updateRules = [
    'entity_type' => 'required|string|max:100',
    'entity_id' => 'nullable|integer|min:1',
    'action' => 'required|string|max:120',
    'old_values' => 'nullable|array',
    'new_values' => 'nullable|array',
    'ip_address' => 'nullable|string|max:45',
    'user_agent' => 'nullable|string|max:500',
    'performed_by' => 'nullable|exists:users,id',
    'performed_at' => 'nullable|date',
    ];
}
