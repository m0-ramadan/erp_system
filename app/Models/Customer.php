<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Customer extends Model
    {
        use HasFactory;

        protected $table = 'customers';

        protected $fillable = [
            'customer_code',
        'company_name',
        'customer_type',
        'tax_number',
        'commercial_register',
        'email',
        'phone',
        'address_line1',
        'address_line2',
        'city',
        'country',
        'assigned_sales_rep_id',
        'status',
        'notes',
        'created_by'
        ];

    public function contacts()
    {
        return $this->hasMany(CustomerContact::class);
    }

    public function primaryContact()
    {
        return $this->hasOne(CustomerContact::class)->where('is_primary', true);
    }

    public function assignedSalesRep()
    {
        return $this->belongsTo(User::class, 'assigned_sales_rep_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function quoteRequests()
    {
        return $this->hasMany(QuoteRequest::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }

    public function salesOrders()
    {
        return $this->hasMany(SalesOrder::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
