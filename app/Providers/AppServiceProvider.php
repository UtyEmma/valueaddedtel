<?php

namespace App\Providers;

use App\Enums\Roles;
use App\Enums\Status;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        Paginator::useBootstrapFive();

        if(!app()->runningInConsole()){
            View::share([
                'statuses' => Status::class,
                'roles' => Roles::class,
                'settings' => new Setting(),
                'countries' => new Country(),
                'currencies' => new Currency()
            ]);
        }
    }
}
