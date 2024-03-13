<?php

namespace Database\Seeders;

use App\Models\Packages\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {

        $packages = config('packages.list');

        foreach($packages as $package) {
            Package::firstOrCreate([
                'name' => $package['name']
            ], $package);
        }

    }
}
