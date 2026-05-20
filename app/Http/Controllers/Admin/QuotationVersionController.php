<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quotation;
use App\Models\QuotationVersion;
use Illuminate\Http\Request;

class QuotationVersionController extends AdminCrudController
{
    protected string $modelClass = QuotationVersion::class;
    protected string $viewPath = 'Admin.quotation_versions';
    protected array $with = ['quotation', 'costEstimation', 'creator', 'items'];
    protected array $searchable = ['notes', 'pdf_path'];
    protected array $filterable = ['quotation_id', 'cost_estimation_id', 'created_by', 'version_reason'];
    protected array $storeRules = [
        'quotation_id' => 'required|exists:quotations,id',
        'version_no' => 'nullable|integer|min:1',
        'cost_estimation_id' => 'nullable|exists:cost_estimations,id',
        'created_by' => 'nullable|exists:users,id',
        'version_reason' => 'nullable|in:initial,revision_requested,internal_revision,price_change,scope_change,correction',
        'subtotal' => 'nullable|numeric|min:0',
        'discount_amount' => 'nullable|numeric|min:0',
        'tax_amount' => 'nullable|numeric|min:0',
        'total_amount' => 'nullable|numeric|min:0',
        'pdf_path' => 'nullable|string|max:500',
        'notes' => 'nullable|string',
    ];
    protected array $updateRules = [
        'quotation_id' => 'nullable|exists:quotations,id',
        'version_no' => 'nullable|integer|min:1',
        'cost_estimation_id' => 'nullable|exists:cost_estimations,id',
        'created_by' => 'nullable|exists:users,id',
        'version_reason' => 'nullable|in:initial,revision_requested,internal_revision,price_change,scope_change,correction',
        'subtotal' => 'nullable|numeric|min:0',
        'discount_amount' => 'nullable|numeric|min:0',
        'tax_amount' => 'nullable|numeric|min:0',
        'total_amount' => 'nullable|numeric|min:0',
        'pdf_path' => 'nullable|string|max:500',
        'notes' => 'nullable|string',
    ];

    protected function beforeStore(array $data, Request $request): array
    {
        if (empty($data['version_no']) && ! empty($data['quotation_id'])) {
            $data['version_no'] = ((int) QuotationVersion::where('quotation_id', $data['quotation_id'])->max('version_no')) + 1;
        }

        $data['created_by'] = $data['created_by'] ?? auth()->id();
        $data['total_amount'] = $data['total_amount'] ?? (($data['subtotal'] ?? 0) - ($data['discount_amount'] ?? 0) + ($data['tax_amount'] ?? 0));

        return $data;
    }

    protected function afterStore(\Illuminate\Database\Eloquent\Model $item, Request $request): void
    {
        Quotation::where('id', $item->quotation_id)->update(['current_version_no' => $item->version_no]);
    }
}
