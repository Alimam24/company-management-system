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
        return $this->belongsTo(city::class);
    }

    public function employees()
    {
        return $this->morphMany(employee::class,'assignable');
    }

    public function manager()
    {
        return $this->belongsTo(employee::class, 'manager_id');
    }

    public function products()
    {
        return $this->belongsToMany(product::class, 'product_store')
                    ->withPivot('amount')
                    ->withTimestamps();
    }

    public function warehouses()
    {
        return $this->belongsToMany(warehouse::class, 'store_warehouse')
                    ->withTimestamps();
    }
}

