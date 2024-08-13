<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReferralDistribution;

class ReferralDistributionSeeder extends Seeder
{
    public function run()
    {
        $distributions = [
            ['level' => 1, 'percentage' => 20],
            ['level' => 2, 'percentage' => 15],
            ['level' => 3, 'percentage' => 15],
            ['level' => 4, 'percentage' => 10],
            ['level' => 5, 'percentage' => 10],
            ['level' => 6, 'percentage' => 10],
            ['level' => 7, 'percentage' => 5],
            ['level' => 8, 'percentage' => 5],
            ['level' => 9, 'percentage' => 5],
            ['level' => 10, 'percentage' => 5],
        ];

        foreach ($distributions as $distribution) {
            ReferralDistribution::updateOrCreate(
                ['level' => $distribution['level']], // Unique key for update or create
                ['percentage' => $distribution['percentage']]
            );
        }
    }
}
