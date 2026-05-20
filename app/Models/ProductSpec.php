<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class ProductSpec extends Model
    {
        use HasFactory;

        protected $table = 'product_specs';

        protected $fillable = [
            'product_id',
        'spec_name',
        'spec_value',
        'unit',
        'is_required'
        ];


        protected $casts = [
            'is_required' => 'boolean'
        ];

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
