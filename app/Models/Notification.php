<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Notification extends Model
    {
        use HasFactory;

        protected $table = 'notifications';

        protected $fillable = [
            'related_entity_type',
        'related_entity_id',
        'notification_type',
        'title',
        'body',
        'status',
        'created_by',
        'sent_at'
        ];


        protected $casts = [
            'sent_at' => 'datetime'
        ];

    public $timestamps = false;

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function recipients()
    {
        return $this->hasMany(NotificationRecipient::class);
    }
}
