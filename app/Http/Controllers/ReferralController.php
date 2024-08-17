<?php

namespace App\Http\Controllers;

use App\Models\ReferralChain;
use App\Models\User;
use Illuminate\Http\Request;

// class ReferralController extends Controller
// {
//     /**
//      * Display the referral data for the logged-in user.
//      */
//     public function referral_data(Request $request)
//     {
//         // Get the logged-in user
//         $user = $request->user();

//         // Fetch the referral chain for the logged-in user
//         $referralChains = ReferralChain::where('ref_by', $user->id)->get();

//         // Transform the data for the frontend
//         $referralData = $referralChains->map(function ($referral) {
//             return [
//                 'referral_name' => User::find($referral->ref_to)->f_name . ' ' . User::find($referral->ref_to)->l_name,
//                 'level' => $referral->level,
//                 'amount_received' => $referral->amount_received ?? 0, // If amount_received is null, default to 0
//             ];
//         });

//         return response()->json([
//             'referrals' => $referralData,
//         ], 200);
//     }
// }

class ReferralController extends Controller
{
    /**
     * Display the referral data for the logged-in user.
     */
    public function referral_data(Request $request)
    {
        // Get the logged-in user
        $user = $request->user();

        // Fetch the referral chain for the logged-in user
        $referralChains = ReferralChain::where('ref_by', $user->id)->get();

        // Transform the data for the frontend
        $referralData = $referralChains->map(function ($referral) {
            $referredUser = User::find($referral->ref_to);
            return [
                'referral_name' => $referredUser ? $referredUser->f_name . ' ' . $referredUser->l_name : 'Unknown',
                'level' => $referral->level,
                'amount_received' => $referral->amount_received ?? 0, // If amount_received is null, default to 0
            ];
        });

        return response()->json([
            'referrals' => $referralData,
        ], 200);
    }
}