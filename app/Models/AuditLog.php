<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class AuditLog extends Model
    {
        use HasFactory;

        protected $table = 'audit_logs';

        protected $fillable = [
            'entity_type',
        'entity_id',
        'action',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
        'performed_by',
        'performed_at'
        ];


        protected $casts = [
            'old_values' => 'array',
        'new_values' => 'array',
        'performed_at' => 'datetime'
        ];

    public $timestamps = false;

    public function performer()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}
