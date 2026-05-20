<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class CostEstimationItem extends Model
    {
        use HasFactory;

        protected $table = 'cost_estimation_items';

        protected $fillable = [
            'cost_estimation_id',
        'quote_request_item_id',
        'line_no',
        'description',
        'cost_type',
        'quantity',
        'unit',
        'unit_cost',
        'total_cost',
        'supplier_name',
        'notes'
        ];


        protected $casts = [
            'quantity' => 'decimal:3',
        'unit_cost' => 'decimal:4',
        'total_cost' => 'decimal:2'
        ];

    public $timestamps = false;

    public function costEstimation()
    {
        return $this->belongsTo(CostEstimation::class);
    }

    public function quoteRequestItem()
    {
        return $this->belongsTo(QuoteRequestItem::class);
    }
}
