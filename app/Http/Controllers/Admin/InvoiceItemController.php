<?php

namespace App\Http\Controllers\Admin;

use App\Models\InvoiceItem;

class InvoiceItemController extends AdminCrudController
{
    protected string $modelClass = InvoiceItem::class;
    protected string $viewPath = 'Admin.invoice_items';
    protected array $with = ['invoice'];
    protected array $searchable = ['description'];
    protected array $filterable = ['invoice_id'];
    protected array $storeRules = [
        'invoice_id' => 'required|exists:invoices,id',
        'line_no' => 'required|integer|min:1',
        'description' => 'required|string|max:255',
        'quantity' => 'required|numeric|min:0',
        'unit' => 'required|string|max:50',
        'unit_price' => 'required|numeric|min:0',
        'discount_percent' => 'nullable|numeric|min:0',
        'tax_percent' => 'nullable|numeric|min:0',
        'line_total' => 'nullable|numeric|min:0',
    ];
    protected array $updateRules = [
        'invoice_id' => 'nullable|exists:invoices,id',
        'line_no' => 'nullable|integer|min:1',
        'description' => 'nullable|string|max:255',
        'quantity' => 'nullable|numeric|min:0',
        'unit' => 'nullable|string|max:50',
        'unit_price' => 'nullable|numeric|min:0',
        'discount_percent' => 'nullable|numeric|min:0',
        'tax_percent' => 'nullable|numeric|min:0',
        'line_total' => 'nullable|numeric|min:0',
    ];
}
