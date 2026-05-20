<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Product extends Model
    {
        use HasFactory;

        protected $table = 'products';

        protected $fillable = [
            'sku',
        'name',
        'category',
        'unit',
        'description',
        'is_active'
        ];


        protected $casts = [
            'is_active' => 'boolean'
        ];

    public function specs()
    {
        return $this->hasMany(ProductSpec::class);
    }

    public function quoteRequestItems()
    {
        return $this->hasMany(QuoteRequestItem::class);
    }

    public function quotationItems()
    {
        return $this->hasMany(QuotationItem::class);
    }
}
