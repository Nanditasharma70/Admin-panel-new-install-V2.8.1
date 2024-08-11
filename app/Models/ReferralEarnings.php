<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralEarnings extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'referred_by',
        'referred_amount',
        'level',
        'email',
        'username',
        'password',
    ];

    // If you want to add additional model configurations, you can do it here
}
