<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Currency extends Model
    {
        use HasFactory;

        protected $table = 'currencies';

        protected $fillable = [
            'code',
        'name',
        'symbol',
        'exchange_rate_to_base',
        'is_base',
        'is_active'
        ];


        protected $casts = [
            'exchange_rate_to_base' => 'decimal:6',
        'is_base' => 'boolean',
        'is_active' => 'boolean'
        ];

    public $timestamps = false;

    public function quoteRequests()
    {
        return $this->hasMany(QuoteRequest::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }
}
