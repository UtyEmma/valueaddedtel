<?php

namespace Database\Seeders;

use App\Models\Countries\Country;
use App\Models\Services\CountryService;
use App\Models\Services\CountryServiceProvider;
use App\Models\Services\Service;
use App\Models\Services\ServiceProduct;
use App\Models\Services\ServiceProvider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {

        $serviceProviders = config('payments.service_providers');
        $services = config('payments.services');

        collect($serviceProviders)->each(function($provider, $key) {
            if(!ServiceProvider::where('shortcode', $key)->exists()) {
                $countries = $provider['countries'];
                $provider = ServiceProvider::create([
                    'name' =>  $provider['name'],
                    'shortcode' => $provider['shortcode']
                ]);
                foreach($countries as $country){
                    if($country = Country::where('iso_code', $country)->isSupported()->first()) {
                        CountryServiceProvider::create([
                            'country_code' => $country->iso_code,
                            'provider_code' => $provider->shortcode
                        ]);
                    }
                }
            }
        });

        collect($services)->each(function($item, $key){
            if(!Service::where('shortcode', $item['shortcode'])->exists()){
                $service = Service::create([
                    'name' => $item['name'],
                    'shortcode' => $item['shortcode']
                ]);

                if(isset($item['countries'])) {
                    foreach($item['countries'] as $key => $countryItem) {
                        if($country = Country::where('iso_code', $key)->isSupported()->first()) {
                            CountryService::create([
                                'country_code' => $country->iso_code,
                                'service_code' => $service->shortcode
                            ]);

                            $products = $countryItem['products'];
                            $provider = ServiceProvider::find($countryItem['provider_code']);

                            if(CountryServiceProvider::where([
                                'country_code' => $country->iso_code,
                                'provider_code' => $provider->shortcode
                            ])->first()){
                                foreach($products as $key => $product){
                                    $product['provider_code'] = $provider->shortcode;
                                    $product['country_code'] = $country->iso_code;
                                    $product['meta'] = [];
                                    $product['shortcode'] = implode('_', [$service->shortcode, $product['shortcode']]);

                                    $items = $product['items'] ?? null;

                                    if(isset($product['items'])) unset($product['items']);

                                    $newProduct = $service->products()->create($product);

                                    if($items) {
                                        foreach($items as $item){
                                            $newProduct->items()->create($item);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        });
    }
}
