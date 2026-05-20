<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class ProductionLog extends Model
    {
        use HasFactory;

        protected $table = 'production_logs';

        protected $fillable = [
            'job_ticket_id',
        'production_plan_id',
        'logged_by',
        'log_type',
        'progress_percent',
        'description',
        'logged_at'
        ];


        protected $casts = [
            'progress_percent' => 'decimal:2',
        'logged_at' => 'datetime'
        ];

    public $timestamps = false;

    public function jobTicket()
    {
        return $this->belongsTo(JobTicket::class);
    }

    public function productionPlan()
    {
        return $this->belongsTo(ProductionPlan::class);
    }

    public function logger()
    {
        return $this->belongsTo(User::class, 'logged_by');
    }
}
