<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class DesignReview extends Model
    {
        use HasFactory;

        protected $table = 'design_reviews';

        protected $fillable = [
            'quote_request_id',
        'reviewed_by',
        'feasibility_status',
        'decision',
        'design_notes',
        'rejection_reason',
        'reviewed_at'
        ];


        protected $casts = [
            'reviewed_at' => 'datetime'
        ];

    public function quoteRequest()
    {
        return $this->belongsTo(QuoteRequest::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
