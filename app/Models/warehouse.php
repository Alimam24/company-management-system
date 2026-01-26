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
        return $this->belongsToMany(product::class, 'product_warehouse')
                    ->withPivot('amount')
                    ->withTimestamps();
    }

    public function stores()
    {
        return $this->belongsToMany(retail_store::class, 'store_warehouse')
                    ->withTimestamps();
    }
}
