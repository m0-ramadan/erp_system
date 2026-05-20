<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class WorkflowStep extends Model
    {
        use HasFactory;

        protected $table = 'workflow_steps';

        protected $fillable = [
            'code',
        'name',
        'lane',
        'role_code',
        'step_type',
        'sort_order',
        'is_terminal',
        'description'
        ];


        protected $casts = [
            'is_terminal' => 'boolean'
        ];

    public $timestamps = false;

    public function outgoingTransitions()
    {
        return $this->hasMany(WorkflowTransition::class, 'from_step_code', 'code');
    }

    public function incomingTransitions()
    {
        return $this->hasMany(WorkflowTransition::class, 'to_step_code', 'code');
    }

    public function tasks()
    {
        return $this->hasMany(WorkflowTask::class, 'step_code', 'code');
    }
}
