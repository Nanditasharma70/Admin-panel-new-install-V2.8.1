<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\ReferralChain;
use App\Models\ReferralDistribution;
use App\Models\User;
use App\Models\AdminWallet;

class ReferralDistributionController extends Controller
{
    public function distributeCommission($orderId)
    {
        DB::beginTransaction();
        try {
            // Get the admin commission amount
            $adminWallet = AdminWallet::firstOrFail();
            $totalAdminCommission = $adminWallet->total_commission_earning;

            // Calculate 50% of the total admin commission
            $distributionAmount = $totalAdminCommission * 0.50;

            // Get referral chains for the order
            $referralChains = ReferralChain::where('order_id', $orderId)->get();

            foreach ($referralChains as $chain) {
                $level = $chain->level;
                $percentage = ReferralDistribution::where('level', $level)->value('percentage');
                
                if ($percentage) {
                    // Calculate the amount to distribute for this level
                    $amountToDistribute = ($distributionAmount * ($percentage / 100));
                    
                    // Update the referral chain with the amount received
                    $chain->update(['amount_received' => $amountToDistribute]);
                    
                    // Add the amount to the user's wallet
                    $user = User::find($chain->ref_to);
                    if ($user) {
                        $userWallet = $user->wallet;
                        $userWallet->total_earning += $amountToDistribute;
                        $userWallet->save();
                    }
                }
            }
            
            // Optionally, you might want to reset or adjust the total commission in the AdminWallet if needed
            $adminWallet->total_commission_earning -= $distributionAmount;
            $adminWallet->save();
            
            DB::commit();
            return response()->json(['message' => 'Referral distribution successful'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Referral distribution failed: ' . $e->getMessage());
            return response()->json(['message' => 'Referral distribution failed'], 500);
        }
    }
}
