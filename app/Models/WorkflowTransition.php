<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class WorkflowTransition extends Model
    {
        use HasFactory;

        protected $table = 'workflow_transitions';

        protected $fillable = [
            'from_step_code',
        'to_step_code',
        'condition_code',
        'condition_label',
        'is_default',
        'description'
        ];


        protected $casts = [
            'is_default' => 'boolean'
        ];

    public $timestamps = false;

    public function fromStep()
    {
        return $this->belongsTo(WorkflowStep::class, 'from_step_code', 'code');
    }

    public function toStep()
    {
        return $this->belongsTo(WorkflowStep::class, 'to_step_code', 'code');
    }
}
