<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class QuotationVersion extends Model
    {
        use HasFactory;

        protected $table = 'quotation_versions';

        protected $fillable = [
            'quotation_id',
        'version_no',
        'cost_estimation_id',
        'created_by',
        'version_reason',
        'subtotal',
        'discount_amount',
        'tax_amount',
        'total_amount',
        'pdf_path',
        'notes'
        ];


        protected $casts = [
            'version_no' => 'integer',
        'subtotal' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2'
        ];

    public $timestamps = false;

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function costEstimation()
    {
        return $this->belongsTo(CostEstimation::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items()
    {
        return $this->hasMany(QuotationItem::class);
    }

    public function files()
    {
        return $this->hasMany(QuotationFile::class);
    }
}
