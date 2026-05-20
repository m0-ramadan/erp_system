<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Delivery extends Model
    {
        use HasFactory;

        protected $table = 'deliveries';

        protected $fillable = [
            'dispatch_id',
        'sales_order_id',
        'delivery_no',
        'status',
        'received_by_name',
        'received_by_phone',
        'proof_file_path',
        'delivered_at',
        'confirmed_by',
        'notes'
        ];


        protected $casts = [
            'delivered_at' => 'datetime'
        ];

    public $timestamps = false;

    public function dispatch()
    {
        return $this->belongsTo(Dispatch::class);
    }

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class);
    }

    public function confirmer()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }
}
