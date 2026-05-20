<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class WorkflowInstance extends Model
    {
        use HasFactory;

        protected $table = 'workflow_instances';

        protected $fillable = [
            'entity_type',
        'entity_id',
        'current_step_code',
        'status',
        'started_by',
        'started_at',
        'completed_at',
        'cancelled_at'
        ];


        protected $casts = [
            'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime'
        ];

    public $timestamps = false;

    public function currentStep()
    {
        return $this->belongsTo(WorkflowStep::class, 'current_step_code', 'code');
    }

    public function starter()
    {
        return $this->belongsTo(User::class, 'started_by');
    }

    public function tasks()
    {
        return $this->hasMany(WorkflowTask::class);
    }

    public function history()
    {
        return $this->hasMany(WorkflowHistory::class);
    }

    public function openTasks()
    {
        return $this->hasMany(WorkflowTask::class)->whereIn('task_status', ['open', 'in_progress']);
    }
}
