<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class SalesOrder extends Model
    {
        use HasFactory;

        protected $table = 'sales_orders';

        protected $fillable = [
            'quotation_id',
        'quotation_version_id',
        'order_no',
        'customer_id',
        'sales_rep_id',
        'status',
        'order_date',
        'planned_delivery_date',
        'total_amount',
        'hold_reason',
        'cancel_reason',
        'reopened_reason',
        'created_by',
        'held_at',
        'cancelled_at',
        'closed_at',
        'reopened_at'
        ];


        protected $casts = [
            'order_date' => 'date',
        'planned_delivery_date' => 'date',
        'total_amount' => 'decimal:2',
        'held_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'closed_at' => 'datetime',
        'reopened_at' => 'datetime'
        ];

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

    public function salesRep()
    {
        return $this->belongsTo(User::class, 'sales_rep_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function jobTickets()
    {
        return $this->hasMany(JobTicket::class);
    }

    public function dispatches()
    {
        return $this->hasMany(Dispatch::class);
    }

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
