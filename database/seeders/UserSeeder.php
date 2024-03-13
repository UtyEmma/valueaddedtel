<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\Countries\Country;
use App\Models\Countries\Currency;
use App\Models\KYC\AccountTier;
use App\Models\Packages\Package;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {

    public function run(): void {
        if(!User::superAdmin()->exists()){
            $country = Country::isDefault()->first();
            $currency = Currency::isDefault()->first();

            $package = Package::orderBy('bonus')->first();
            $tier = AccountTier::orderBy('level')->first();

            $user = new User([
                'firstname' => 'Super',
                'lastname' => 'Admin',
                'email' => env('APP_EMAIL'),
                'username' => 'ceoxtravalue',
                'phone' => '08037610045',
                'role' => Roles::SUPERADMIN,
                'password' => Hash::make('1234567890'),
                'email_verified_at' => now()
            ]);

            $user->country()->associate($country);
            $user->currency()->associate($currency);
            $user->package()->associate($package);
            $user->tier()->associate($tier);

            $user->save();
            $user->wallet()->create();
        }

    }
}
