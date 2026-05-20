<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class NotificationRecipient extends Model
    {
        use HasFactory;

        protected $table = 'notification_recipients';

        protected $fillable = [
            'notification_id',
        'user_id',
        'customer_contact_id',
        'recipient_email',
        'recipient_phone',
        'delivery_status',
        'delivered_at',
        'read_at'
        ];


        protected $casts = [
            'delivered_at' => 'datetime',
        'read_at' => 'datetime'
        ];

    public $timestamps = false;

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customerContact()
    {
        return $this->belongsTo(CustomerContact::class);
    }
}
