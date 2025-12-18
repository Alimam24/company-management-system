<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

   public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function user(){
        return $this->hasOne(user::class);
    }

    public function emp_role(){
        return $this->belongsTo(emp_role::class);

    }

    public function department()
    {
        return $this->belongsTo(department::class);
    }

    public function emp_state()
    {
        return $this->belongsTo(emp_state::class);
    }
    
    public function assignable()
    {
        return $this->morphTo();
    }

    public function assignedVIPCustomers()
    {
        return $this->hasMany(MarketingEmployeeCustomer::class)->with('customer');
    }
    
}
