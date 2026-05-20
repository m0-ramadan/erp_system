<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class InvoiceItem extends Model
    {
        use HasFactory;

        protected $table = 'invoice_items';

        protected $fillable = [
            'invoice_id',
        'line_no',
        'description',
        'quantity',
        'unit',
        'unit_price',
        'discount_percent',
        'tax_percent',
        'line_total'
        ];


        protected $casts = [
            'quantity' => 'decimal:3',
        'unit_price' => 'decimal:4',
        'discount_percent' => 'decimal:3',
        'tax_percent' => 'decimal:3',
        'line_total' => 'decimal:2'
        ];

    public $timestamps = false;

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
