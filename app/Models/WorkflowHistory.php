<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class WorkflowHistory extends Model
    {
        use HasFactory;

        protected $table = 'workflow_history';

        protected $fillable = [
            'workflow_instance_id',
        'from_step_code',
        'to_step_code',
        'transition_id',
        'action_code',
        'action_label',
        'comments',
        'acted_by',
        'acted_at'
        ];


        protected $casts = [
            'acted_at' => 'datetime'
        ];

    public $timestamps = false;

    public function instance()
    {
        return $this->belongsTo(WorkflowInstance::class, 'workflow_instance_id');
    }

    public function fromStep()
    {
        return $this->belongsTo(WorkflowStep::class, 'from_step_code', 'code');
    }

    public function toStep()
    {
        return $this->belongsTo(WorkflowStep::class, 'to_step_code', 'code');
    }

    public function transition()
    {
        return $this->belongsTo(WorkflowTransition::class);
    }

    public function actor()
    {
        return $this->belongsTo(User::class, 'acted_by');
    }
}
