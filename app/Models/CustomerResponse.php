<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class CustomerResponse extends Model
    {
        use HasFactory;

        protected $table = 'customer_responses';

        protected $fillable = [
            'quotation_id',
        'quotation_version_id',
        'customer_id',
        'contact_id',
        'response',
        'response_notes',
        'revision_details',
        'rejection_reason',
        'responded_at',
        'recorded_by'
        ];


        protected $casts = [
            'responded_at' => 'datetime'
        ];

    public $timestamps = false;

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function quotationVersion()
    {
        return $this->belongsTo(QuotationVersion::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function contact()
    {
        return $this->belongsTo(CustomerContact::class, 'contact_id');
    }

    public function recorder()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
