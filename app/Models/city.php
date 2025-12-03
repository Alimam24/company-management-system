<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    public function retail_store()
    {
        return $this->hasMany(Retail_Store::class);
    }

    public function warehouse()
    {
        return $this->hasMany(warehouse::class);
    }
}
