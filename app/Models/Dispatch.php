<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Dispatch extends Model
    {
        use HasFactory;

        protected $table = 'dispatches';

        protected $fillable = [
            'sales_order_id',
        'job_ticket_id',
        'dispatch_no',
        'status',
        'carrier_name',
        'tracking_no',
        'dispatch_address',
        'dispatched_by',
        'dispatched_at',
        'notes'
        ];


        protected $casts = [
            'dispatched_at' => 'datetime'
        ];

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class);
    }

    public function jobTicket()
    {
        return $this->belongsTo(JobTicket::class);
    }

    public function dispatcher()
    {
        return $this->belongsTo(User::class, 'dispatched_by');
    }

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }
}
