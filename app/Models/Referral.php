<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref_code', 'ref_by','ref_to', 'level',
    ];

    public function referrer()
    {
        return $this->belongsTo(User::class, 'ref_by');
    }

    public function referred()
    {
        return $this->belongsTo(User::class, 'ref_to');
    }
}
