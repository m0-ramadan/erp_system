<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class ManagementApproval extends Model
    {
        use HasFactory;

        protected $table = 'management_approvals';

        protected $fillable = [
            'quote_request_id',
        'quotation_id',
        'approved_by',
        'decision',
        'approval_limit_amount',
        'comments',
        'decided_at'
        ];


        protected $casts = [
            'approval_limit_amount' => 'decimal:2',
        'decided_at' => 'datetime'
        ];

    public function quoteRequest()
    {
        return $this->belongsTo(QuoteRequest::class);
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
