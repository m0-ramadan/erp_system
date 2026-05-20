<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class QualityCheck extends Model
    {
        use HasFactory;

        protected $table = 'quality_checks';

        protected $fillable = [
            'job_ticket_id',
        'checked_by',
        'result',
        'checklist',
        'defects_found',
        'corrective_action',
        'checked_at'
        ];


        protected $casts = [
            'checklist' => 'array',
        'checked_at' => 'datetime'
        ];

    public $timestamps = false;

    public function jobTicket()
    {
        return $this->belongsTo(JobTicket::class);
    }

    public function checker()
    {
        return $this->belongsTo(User::class, 'checked_by');
    }
}
