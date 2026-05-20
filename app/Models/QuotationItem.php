<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class QuotationItem extends Model
    {
        use HasFactory;

        protected $table = 'quotation_items';

        protected $fillable = [
            'quotation_version_id',
        'quote_request_item_id',
        'line_no',
        'product_id',
        'description',
        'quantity',
        'unit',
        'unit_price',
        'discount_percent',
        'tax_percent',
        'line_total',
        'specs',
        'notes'
        ];


        protected $casts = [
            'quantity' => 'decimal:3',
        'unit_price' => 'decimal:4',
        'discount_percent' => 'decimal:3',
        'tax_percent' => 'decimal:3',
        'line_total' => 'decimal:2',
        'specs' => 'array'
        ];

    public $timestamps = false;

    public function quotationVersion()
    {
        return $this->belongsTo(QuotationVersion::class);
    }

    public function quoteRequestItem()
    {
        return $this->belongsTo(QuoteRequestItem::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
