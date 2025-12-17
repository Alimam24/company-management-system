<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer_state extends Model
{
    public function customers()
    {
        return $this->hasMany(customer::class);
    }
}
