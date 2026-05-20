<?php

namespace App\Http\Controllers\Admin;

use App\Models\CostEstimationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CostEstimationItemController extends AdminCrudController
{
    protected string $modelClass = CostEstimationItem::class;
    protected string $viewPath = 'Admin.cost_estimation_items';
    protected array $with = ['costEstimation', 'quoteRequestItem'];
    protected array $searchable = ['description', 'supplier_name'];
    protected array $filterable = ['cost_estimation_id', 'quote_request_item_id', 'cost_type'];
    protected array $storeRules = [
    'cost_estimation_id' => 'required|exists:cost_estimations,id',
    'quote_request_item_id' => 'nullable|exists:quote_request_items,id',
    'line_no' => 'required|integer|min:1',
    'description' => 'required|string|max:255',
    'cost_type' => 'nullable|in:material,labor,overhead,subcontract,other',
    'quantity' => 'required|numeric|min:0',
    'unit' => 'required|string|max:50',
    'unit_cost' => 'required|numeric|min:0',
    'total_cost' => 'nullable|numeric|min:0',
    'supplier_name' => 'nullable|string|max:255',
    'notes' => 'nullable|string',
    ];
    protected array $updateRules = [
    'cost_estimation_id' => 'required|exists:cost_estimations,id',
    'quote_request_item_id' => 'nullable|exists:quote_request_items,id',
    'line_no' => 'required|integer|min:1',
    'description' => 'required|string|max:255',
    'cost_type' => 'nullable|in:material,labor,overhead,subcontract,other',
    'quantity' => 'required|numeric|min:0',
    'unit' => 'required|string|max:50',
    'unit_cost' => 'required|numeric|min:0',
    'total_cost' => 'nullable|numeric|min:0',
    'supplier_name' => 'nullable|string|max:255',
    'notes' => 'nullable|string',
    ];
}
