<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class QuoteRequest extends Model
    {
        use HasFactory;

        protected $table = 'quote_requests';

        protected $fillable = [
            'request_no',
        'request_source',
        'customer_id',
        'contact_id',
        'created_by',
        'sales_rep_id',
        'sales_coordinator_id',
        'assigned_estimation_user_id',
        'title',
        'project_name',
        'priority',
        'requested_delivery_date',
        'currency_id',
        'status',
        'completeness_status',
        'customer_requirements',
        'internal_notes',
        'submitted_at',
        'closed_at',
        'cancelled_at'
        ];


        protected $casts = [
            'requested_delivery_date' => 'date',
        'submitted_at' => 'datetime',
        'closed_at' => 'datetime',
        'cancelled_at' => 'datetime'
        ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function contact()
    {
        return $this->belongsTo(CustomerContact::class, 'contact_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function salesRep()
    {
        return $this->belongsTo(User::class, 'sales_rep_id');
    }

    public function salesCoordinator()
    {
        return $this->belongsTo(User::class, 'sales_coordinator_id');
    }

    public function estimationOfficer()
    {
        return $this->belongsTo(User::class, 'assigned_estimation_user_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function items()
    {
        return $this->hasMany(QuoteRequestItem::class);
    }

    public function files()
    {
        return $this->hasMany(RequestFile::class);
    }

    public function clarifications()
    {
        return $this->hasMany(Clarification::class);
    }

    public function costEstimations()
    {
        return $this->hasMany(CostEstimation::class);
    }

    public function latestCostEstimation()
    {
        return $this->hasOne(CostEstimation::class)->latestOfMany();
    }

    public function designReviews()
    {
        return $this->hasMany(DesignReview::class);
    }

    public function accountsReviews()
    {
        return $this->hasMany(AccountsReview::class);
    }

    public function managementApprovals()
    {
        return $this->hasMany(ManagementApproval::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }

    public function workflowInstances()
    {
        return $this->hasMany(WorkflowInstance::class, 'entity_id')->where('entity_type', 'quote_request');
    }
}
