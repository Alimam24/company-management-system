<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

    public function person()
    {
        return $this->belongsTo(Person::class);
    }


    public function customer_type()
    {
        return $this->belongsTo(customer_type::class);
    }

    public function customer_state()
    {
        return $this->belongsTo(Customer_state::class);
    }

    public function marketingEmployee()
    {
        return $this->hasOne(MarketingEmployeeCustomer::class)->with('employee');
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'customer_offer')
            ->withPivot('AssignedDate')
            ->withTimestamps();
    }
    
}
