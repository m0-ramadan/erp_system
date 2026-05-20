<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Quotation extends Model
    {
        use HasFactory;

        protected $table = 'quotations';

        protected $fillable = [
            'quote_request_id',
        'quotation_no',
        'current_version_no',
        'customer_id',
        'sales_rep_id',
        'currency_id',
        'payment_terms_id',
        'quotation_date',
        'valid_until',
        'subtotal',
        'discount_amount',
        'tax_amount',
        'total_amount',
        'status',
        'pdf_path',
        'notes',
        'created_by',
        'sent_at',
        'accepted_at',
        'rejected_at'
        ];


        protected $casts = [
            'current_version_no' => 'integer',
        'quotation_date' => 'date',
        'valid_until' => 'date',
        'subtotal' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'sent_at' => 'datetime',
        'accepted_at' => 'datetime',
        'rejected_at' => 'datetime'
        ];

    public function quoteRequest()
    {
        return $this->belongsTo(QuoteRequest::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function salesRep()
    {
        return $this->belongsTo(User::class, 'sales_rep_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function paymentTerm()
    {
        return $this->belongsTo(PaymentTerm::class, 'payment_terms_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function versions()
    {
        return $this->hasMany(QuotationVersion::class);
    }

    public function currentVersion()
    {
        return $this->hasOne(QuotationVersion::class)->latestOfMany('version_no');
    }

    public function files()
    {
        return $this->hasMany(QuotationFile::class);
    }

    public function customerResponses()
    {
        return $this->hasMany(CustomerResponse::class);
    }

    public function salesOrders()
    {
        return $this->hasMany(SalesOrder::class);
    }
}
