<?php

namespace App\Http\Controllers\Admin;

use App\Models\QuotationFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class QuotationFileController extends AdminCrudController
{
    protected string $modelClass = QuotationFile::class;
    protected string $viewPath = 'Admin.quotation_files';
    protected array $with = ['quotation', 'quotationVersion', 'fileType', 'uploader'];
    protected array $searchable = ['original_name', 'stored_name', 'file_path', 'mime_type'];
    protected array $filterable = ['quotation_id', 'quotation_version_id', 'file_type_id', 'uploaded_by'];
    protected array $storeRules = [
    'quotation_id' => 'required|exists:quotations,id',
    'quotation_version_id' => 'nullable|exists:quotation_versions,id',
    'file_type_id' => 'nullable|exists:file_types,id',
    'uploaded_by' => 'nullable|exists:users,id',
    'original_name' => 'required|string|max:255',
    'stored_name' => 'required|string|max:255',
    'file_path' => 'required|string|max:500',
    'mime_type' => 'nullable|string|max:120',
    'size_bytes' => 'nullable|integer|min:0',
    'uploaded_at' => 'nullable|date',
    ];
    protected array $updateRules = [
    'quotation_id' => 'required|exists:quotations,id',
    'quotation_version_id' => 'nullable|exists:quotation_versions,id',
    'file_type_id' => 'nullable|exists:file_types,id',
    'uploaded_by' => 'nullable|exists:users,id',
    'original_name' => 'required|string|max:255',
    'stored_name' => 'required|string|max:255',
    'file_path' => 'required|string|max:500',
    'mime_type' => 'nullable|string|max:120',
    'size_bytes' => 'nullable|integer|min:0',
    'uploaded_at' => 'nullable|date',
    ];
}
