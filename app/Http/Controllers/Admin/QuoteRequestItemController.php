<?php

namespace App\Http\Controllers\Admin;

use App\Models\QuoteRequestItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class QuoteRequestItemController extends AdminCrudController
{
    protected string $modelClass = QuoteRequestItem::class;
    protected string $viewPath = 'Admin.quote_request_items';
    protected array $with = ['quoteRequest', 'product'];
    protected array $searchable = ['product_name', 'description'];
    protected array $filterable = ['quote_request_id', 'product_id'];
    protected array $storeRules = [
    'quote_request_id' => 'required|exists:quote_requests,id',
    'product_id' => 'nullable|exists:products,id',
    'line_no' => 'required|integer|min:1',
    'product_name' => 'required|string|max:255',
    'description' => 'nullable|string',
    'quantity' => 'required|numeric|min:0',
    'unit' => 'required|string|max:50',
    'product_specs' => 'nullable|array',
    'customer_notes' => 'nullable|string',
    ];
    protected array $updateRules = [
    'quote_request_id' => 'required|exists:quote_requests,id',
    'product_id' => 'nullable|exists:products,id',
    'line_no' => 'required|integer|min:1',
    'product_name' => 'required|string|max:255',
    'description' => 'nullable|string',
    'quantity' => 'required|numeric|min:0',
    'unit' => 'required|string|max:50',
    'product_specs' => 'nullable|array',
    'customer_notes' => 'nullable|string',
    ];
}
