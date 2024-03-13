<?php

namespace Database\Seeders;

use App\Models\Countries\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $currencies = config('countries.currencies');

        foreach($currencies as $currency){
            Currency::firstOrCreate([
                'code' => $currency['code']
            ], $currency);
        }
    }
}
