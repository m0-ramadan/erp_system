<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class ProductionPlan extends Model
    {
        use HasFactory;

        protected $table = 'production_plans';

        protected $fillable = [
            'job_ticket_id',
        'planned_by',
        'feasibility_status',
        'feasibility_notes',
        'plan_status',
        'planned_start_date',
        'planned_end_date',
        'actual_start_at',
        'actual_end_at',
        'plan_notes'
        ];


        protected $casts = [
            'planned_start_date' => 'date',
        'planned_end_date' => 'date',
        'actual_start_at' => 'datetime',
        'actual_end_at' => 'datetime'
        ];

    public function jobTicket()
    {
        return $this->belongsTo(JobTicket::class);
    }

    public function planner()
    {
        return $this->belongsTo(User::class, 'planned_by');
    }

    public function logs()
    {
        return $this->hasMany(ProductionLog::class);
    }
}
