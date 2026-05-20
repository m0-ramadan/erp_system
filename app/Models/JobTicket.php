<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class JobTicket extends Model
    {
        use HasFactory;

        protected $table = 'job_tickets';

        protected $fillable = [
            'sales_order_id',
        'ticket_no',
        'status',
        'priority',
        'production_notes',
        'created_by'
        ];

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function productionPlans()
    {
        return $this->hasMany(ProductionPlan::class);
    }

    public function latestProductionPlan()
    {
        return $this->hasOne(ProductionPlan::class)->latestOfMany();
    }

    public function productionLogs()
    {
        return $this->hasMany(ProductionLog::class);
    }

    public function qualityChecks()
    {
        return $this->hasMany(QualityCheck::class);
    }

    public function dispatches()
    {
        return $this->hasMany(Dispatch::class);
    }
}
