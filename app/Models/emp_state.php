<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emp_state extends Model
{
    /** @use HasFactory<\Database\Factories\EmpStateFactory> */
    use HasFactory;
    public function employees()
    {
        return $this->hasMany(employee::class);
    }
}
