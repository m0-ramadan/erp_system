<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class WorkflowTask extends Model
    {
        use HasFactory;

        protected $table = 'workflow_tasks';

        protected $fillable = [
            'workflow_instance_id',
        'step_code',
        'assigned_role_code',
        'assigned_user_id',
        'task_status',
        'due_at',
        'started_at',
        'completed_at',
        'result_code',
        'result_notes'
        ];


        protected $casts = [
            'due_at' => 'datetime',
        'started_at' => 'datetime',
        'completed_at' => 'datetime'
        ];

    public function instance()
    {
        return $this->belongsTo(WorkflowInstance::class, 'workflow_instance_id');
    }

    public function step()
    {
        return $this->belongsTo(WorkflowStep::class, 'step_code', 'code');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }
}
