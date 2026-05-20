<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class AccountsReview extends Model
    {
        use HasFactory;

        protected $table = 'accounts_reviews';

        protected $fillable = [
            'quote_request_id',
        'cost_estimation_id',
        'reviewed_by',
        'decision',
        'credit_limit_checked',
        'payment_terms_id',
        'financial_notes',
        'correction_required',
        'reviewed_at'
        ];


        protected $casts = [
            'credit_limit_checked' => 'boolean',
        'reviewed_at' => 'datetime'
        ];

    public function quoteRequest()
    {
        return $this->belongsTo(QuoteRequest::class);
    }

    public function costEstimation()
    {
        return $this->belongsTo(CostEstimation::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function paymentTerm()
    {
        return $this->belongsTo(PaymentTerm::class, 'payment_terms_id');
    }
}
