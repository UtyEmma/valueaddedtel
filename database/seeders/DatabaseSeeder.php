<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Package;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    public function run(): void {
        $this->call([
            Package::class,
            CountrySeeder::class,
            CurrencySeeder::class,
            KYCSeeder::class,
            UserSeeder::class,
        ]);
    }
}
