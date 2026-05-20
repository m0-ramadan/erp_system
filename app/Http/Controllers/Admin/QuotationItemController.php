<?php

namespace App\Http\Controllers\Admin;

use App\Models\QuotationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class QuotationItemController extends AdminCrudController
{
    protected string $modelClass = QuotationItem::class;
    protected string $viewPath = 'Admin.quotation_items';
    protected array $with = ['quotationVersion', 'product'];
    protected array $searchable = ['description'];
    protected array $filterable = ['quotation_version_id', 'quote_request_item_id', 'product_id'];
    protected array $storeRules = [
    'quotation_version_id' => 'required|exists:quotation_versions,id',
    'quote_request_item_id' => 'nullable|exists:quote_request_items,id',
    'line_no' => 'required|integer|min:1',
    'product_id' => 'nullable|exists:products,id',
    'description' => 'required|string|max:255',
    'quantity' => 'required|numeric|min:0',
    'unit' => 'required|string|max:50',
    'unit_price' => 'required|numeric|min:0',
    'discount_percent' => 'nullable|numeric|min:0',
    'tax_percent' => 'nullable|numeric|min:0',
    'line_total' => 'nullable|numeric|min:0',
    'specs' => 'nullable|array',
    'notes' => 'nullable|string',
    ];
    protected array $updateRules = [
    'quotation_version_id' => 'required|exists:quotation_versions,id',
    'quote_request_item_id' => 'nullable|exists:quote_request_items,id',
    'line_no' => 'required|integer|min:1',
    'product_id' => 'nullable|exists:products,id',
    'description' => 'required|string|max:255',
    'quantity' => 'required|numeric|min:0',
    'unit' => 'required|string|max:50',
    'unit_price' => 'required|numeric|min:0',
    'discount_percent' => 'nullable|numeric|min:0',
    'tax_percent' => 'nullable|numeric|min:0',
    'line_total' => 'nullable|numeric|min:0',
    'specs' => 'nullable|array',
    'notes' => 'nullable|string',
    ];
}
