<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Clarification extends Model
    {
        use HasFactory;

        protected $table = 'clarifications';

        protected $fillable = [
            'quote_request_id',
        'requested_by',
        'assigned_to',
        'question',
        'response',
        'status',
        'requested_at',
        'responded_at',
        'closed_at'
        ];


        protected $casts = [
            'requested_at' => 'datetime',
        'responded_at' => 'datetime',
        'closed_at' => 'datetime'
        ];

    public $timestamps = false;

    public function quoteRequest()
    {
        return $this->belongsTo(QuoteRequest::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
