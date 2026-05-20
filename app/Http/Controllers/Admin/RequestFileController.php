<?php

namespace App\Http\Controllers\Admin;

use App\Models\RequestFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RequestFileController extends AdminCrudController
{
    protected string $modelClass = RequestFile::class;
    protected string $viewPath = 'Admin.request_files';
    protected array $with = ['quoteRequest', 'fileType', 'uploader'];
    protected array $searchable = ['original_name', 'stored_name', 'file_path', 'mime_type'];
    protected array $filterable = ['quote_request_id', 'file_type_id', 'uploaded_by'];
    protected array $storeRules = [
    'quote_request_id' => 'required|exists:quote_requests,id',
    'file_type_id' => 'nullable|exists:file_types,id',
    'uploaded_by' => 'nullable|exists:users,id',
    'original_name' => 'required|string|max:255',
    'stored_name' => 'required|string|max:255',
    'file_path' => 'required|string|max:500',
    'mime_type' => 'nullable|string|max:120',
    'size_bytes' => 'nullable|integer|min:0',
    'notes' => 'nullable|string',
    'uploaded_at' => 'nullable|date',
    ];
    protected array $updateRules = [
    'quote_request_id' => 'required|exists:quote_requests,id',
    'file_type_id' => 'nullable|exists:file_types,id',
    'uploaded_by' => 'nullable|exists:users,id',
    'original_name' => 'required|string|max:255',
    'stored_name' => 'required|string|max:255',
    'file_path' => 'required|string|max:500',
    'mime_type' => 'nullable|string|max:120',
    'size_bytes' => 'nullable|integer|min:0',
    'notes' => 'nullable|string',
    'uploaded_at' => 'nullable|date',
    ];
}
