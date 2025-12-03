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
    
}
