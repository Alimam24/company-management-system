<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class warehouse extends Model
{
    /** @use HasFactory<\Database\Factories\WarehouseFactory> */
    use HasFactory;

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function employees()
    {
        return $this->morphMany(employee::class,'assignable');
    }
}
