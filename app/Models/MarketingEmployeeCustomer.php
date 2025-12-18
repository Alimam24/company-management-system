<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketingEmployeeCustomer extends Model
{
    use HasFactory;

    protected $table = 'marketing_employee_customer';

    public function customer()
    {
        return $this->belongsTo(customer::class);
    }

    public function employee()
    {
        return $this->belongsTo(employee::class);
    }
}

