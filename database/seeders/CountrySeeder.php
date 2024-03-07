<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {

        $countries = config('countries.supported');

        foreach($countries as $country){
            Country::firstOrCreate([
                'iso_code' => $country['iso_code']
            ], $country);
        }
    }
}
