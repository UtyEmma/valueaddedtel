<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    public function run(): void {
        $this->call([
            PackageSeeder::class,
            CountrySeeder::class,
            CurrencySeeder::class,
            KYCSeeder::class,
            UserSeeder::class,
            PaymentMethodSeeder::class,
            ServiceSeeder::class
        ]);
    }
}
