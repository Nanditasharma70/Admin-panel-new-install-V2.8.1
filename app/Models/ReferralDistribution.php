<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralDistribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'level',
        'percentage',
    ];

    // Optional: Define validation rules, if needed
    public static function rules()
    {
        return [
            'level' => 'required|integer|unique:referral_distributions,level',
            'percentage' => 'required|numeric|min:0|max:100',
        ];
    }
}
