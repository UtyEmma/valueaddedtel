<?php

namespace Database\Seeders;

use App\Models\AccountTier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KYCSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tiers = config('kyc.tiers');

        foreach ($tiers as $tier) {
            AccountTier::firstOrCreate([
                'level' => $tier['level']
            ], $tier);
        }
    }
}
