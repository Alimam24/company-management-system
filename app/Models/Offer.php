<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $casts = [
        'StartDate' => 'date',
        'EndDate' => 'date',
        'IsActive' => 'boolean',
    ];

    public function customer_type()
    {
        return $this->belongsTo(customer_type::class);
    }

    public function customers()
    {
        return $this->belongsToMany(customer::class, 'customer_offer')
            ->withPivot('AssignedDate')
            ->withTimestamps();
    }
}

