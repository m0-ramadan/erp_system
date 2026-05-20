<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class PaymentTerm extends Model
    {
        use HasFactory;

        protected $table = 'payment_terms';

        protected $fillable = [
            'code',
        'name',
        'description',
        'days_count',
        'is_active'
        ];


        protected $casts = [
            'is_active' => 'boolean'
        ];

    public $timestamps = false;

    public function quotations()
    {
        return $this->hasMany(Quotation::class, 'payment_terms_id');
    }
}
