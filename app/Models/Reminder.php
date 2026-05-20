<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Reminder extends Model
    {
        use HasFactory;

        protected $table = 'reminders';

        protected $fillable = [
            'related_entity_type',
        'related_entity_id',
        'reminder_type',
        'message',
        'remind_at',
        'sent_at',
        'status',
        'created_by',
        'assigned_to'
        ];


        protected $casts = [
            'remind_at' => 'datetime',
        'sent_at' => 'datetime'
        ];

    public $timestamps = false;

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
