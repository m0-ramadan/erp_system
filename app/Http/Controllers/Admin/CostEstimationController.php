<?php

namespace App\Http\Controllers\Admin;

use App\Models\CostEstimation;
use App\Services\NumberGeneratorService;
use Illuminate\Http\Request;

class CostEstimationController extends AdminCrudController
{
    protected string $modelClass = CostEstimation::class;
    protected string $viewPath = 'Admin.cost_estimations';
    protected array $with = ['quoteRequest', 'estimator', 'items'];
    protected array $searchable = ['estimation_no', 'notes'];
    protected array $filterable = ['quote_request_id', 'estimated_by', 'status'];
    protected array $storeRules = [
        'quote_request_id' => 'required|exists:quote_requests,id',
        'estimation_no' => 'nullable|string|max:80|unique:cost_estimations,estimation_no',
        'version_no' => 'nullable|integer|min:1',
        'estimated_by' => 'nullable|exists:users,id',
        'status' => 'nullable|in:draft,submitted,revised,approved,rejected',
        'material_cost' => 'nullable|numeric|min:0',
        'labor_cost' => 'nullable|numeric|min:0',
        'overhead_cost' => 'nullable|numeric|min:0',
        'subcontract_cost' => 'nullable|numeric|min:0',
        'margin_percent' => 'nullable|numeric|min:0',
        'discount_percent' => 'nullable|numeric|min:0',
        'tax_percent' => 'nullable|numeric|min:0',
        'total_cost' => 'nullable|numeric|min:0',
        'selling_price' => 'nullable|numeric|min:0',
        'notes' => 'nullable|string',
    ];
    protected array $updateRules = [
        'quote_request_id' => 'nullable|exists:quote_requests,id',
        'estimation_no' => 'nullable|string|max:80',
        'version_no' => 'nullable|integer|min:1',
        'estimated_by' => 'nullable|exists:users,id',
        'status' => 'nullable|in:draft,submitted,revised,approved,rejected',
        'material_cost' => 'nullable|numeric|min:0',
        'labor_cost' => 'nullable|numeric|min:0',
        'overhead_cost' => 'nullable|numeric|min:0',
        'subcontract_cost' => 'nullable|numeric|min:0',
        'margin_percent' => 'nullable|numeric|min:0',
        'discount_percent' => 'nullable|numeric|min:0',
        'tax_percent' => 'nullable|numeric|min:0',
        'total_cost' => 'nullable|numeric|min:0',
        'selling_price' => 'nullable|numeric|min:0',
        'notes' => 'nullable|string',
    ];

    protected function beforeStore(array $data, Request $request): array
    {
        if (empty($data['estimation_no'])) {
            $data['estimation_no'] = app(NumberGeneratorService::class)->generate(CostEstimation::class, 'estimation_no', 'EST');
        }

        $data['estimated_by'] = $data['estimated_by'] ?? auth()->id();
        $data['total_cost'] = $data['total_cost'] ?? (($data['material_cost'] ?? 0) + ($data['labor_cost'] ?? 0) + ($data['overhead_cost'] ?? 0) + ($data['subcontract_cost'] ?? 0));

        if (empty($data['selling_price'])) {
            $margin = (float) ($data['margin_percent'] ?? 0);
            $data['selling_price'] = round($data['total_cost'] * (1 + ($margin / 100)), 2);
        }

        return $data;
    }

    public function submit(Request $request, CostEstimation $costEstimation)
    {
        $costEstimation->update(['status' => 'submitted']);
        $costEstimation->quoteRequest?->update(['status' => 'design_review']);

        return response()->json(['success' => true, 'message' => 'تم إرسال التسعير للمراجعة', 'data' => $costEstimation->fresh()]);
    }
}
