<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class CustomerContact extends Model
    {
        use HasFactory;

        protected $table = 'customer_contacts';

        protected $fillable = [
            'customer_id',
        'contact_name',
        'job_title',
        'email',
        'phone',
        'is_primary',
        'notes'
        ];


        protected $casts = [
            'is_primary' => 'boolean'
        ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function quoteRequests()
    {
        return $this->hasMany(QuoteRequest::class, 'contact_id');
    }

    public function responses()
    {
        return $this->hasMany(CustomerResponse::class, 'contact_id');
    }
}
