<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class retail_store extends Model
{
    /** @use HasFactory<\Database\Factories\RetailStoreFactory> */
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
