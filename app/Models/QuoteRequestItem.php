<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class QuoteRequestItem extends Model
    {
        use HasFactory;

        protected $table = 'quote_request_items';

        protected $fillable = [
            'quote_request_id',
        'product_id',
        'line_no',
        'product_name',
        'description',
        'quantity',
        'unit',
        'product_specs',
        'customer_notes'
        ];


        protected $casts = [
            'quantity' => 'decimal:3',
        'product_specs' => 'array'
        ];

    public function quoteRequest()
    {
        return $this->belongsTo(QuoteRequest::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function costEstimationItems()
    {
        return $this->hasMany(CostEstimationItem::class);
    }

    public function quotationItems()
    {
        return $this->hasMany(QuotationItem::class);
    }
}
