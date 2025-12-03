<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emp_role extends Model
{
    /** @use HasFactory<\Database\Factories\EmpRoleFactory> */
    use HasFactory;
    public function employees()
    {
        return $this->hasMany(employee::class);
    }
}
