<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralChain extends Model
{
    protected $fillable = [
        'ref_by',
        'ref_to',
        'level',
        'amount_received',
    ];

    /**
     * Get the user who referred.
     */
    public function referrer()
    {
        return $this->belongsTo(User::class, 'ref_by');
    }

    /**
     * Get the user who was referred.
     */
    public function referred()
    {
        return $this->belongsTo(User::class, 'ref_to');
    }
}
