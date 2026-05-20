<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class CostEstimation extends Model
    {
        use HasFactory;

        protected $table = 'cost_estimations';

        protected $fillable = [
            'quote_request_id',
        'estimation_no',
        'version_no',
        'estimated_by',
        'status',
        'material_cost',
        'labor_cost',
        'overhead_cost',
        'subcontract_cost',
        'margin_percent',
        'discount_percent',
        'tax_percent',
        'total_cost',
        'selling_price',
        'notes'
        ];


        protected $casts = [
            'version_no' => 'integer',
        'material_cost' => 'decimal:2',
        'labor_cost' => 'decimal:2',
        'overhead_cost' => 'decimal:2',
        'subcontract_cost' => 'decimal:2',
        'margin_percent' => 'decimal:3',
        'discount_percent' => 'decimal:3',
        'tax_percent' => 'decimal:3',
        'total_cost' => 'decimal:2',
        'selling_price' => 'decimal:2'
        ];

    public function quoteRequest()
    {
        return $this->belongsTo(QuoteRequest::class);
    }

    public function estimator()
    {
        return $this->belongsTo(User::class, 'estimated_by');
    }

    public function items()
    {
        return $this->hasMany(CostEstimationItem::class);
    }

    public function quotationVersions()
    {
        return $this->hasMany(QuotationVersion::class);
    }
}
