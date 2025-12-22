<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetRequest extends Model
{
    protected $guarded = [
        'user_id',
        'status',
        'resolved_at',
    ];

    protected $casts = [
        'resolved_at',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /*scopes*/
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
