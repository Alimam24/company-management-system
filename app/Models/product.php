<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
     use HasFactory;
    //

    public function retail_stores()
    {
        return $this->belongsToMany(retail_store::class, 'product_store')
                    ->withPivot('amount')
                    ->withTimestamps();
    }

    public function warehouses()
    {
        return $this->belongsToMany(warehouse::class, 'product_warehouse')
                    ->withPivot('amount')
                    ->withTimestamps();
    }
}
