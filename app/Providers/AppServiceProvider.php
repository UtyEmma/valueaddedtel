<?php

namespace App\Providers;

use App\Enums\PaymentMethods;
use App\Enums\PaymentStatus;
use App\Enums\Roles;
use App\Enums\Services;
use App\Enums\Status;
use App\Models\Countries\Country;
use App\Models\Countries\Currency;
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
                'currencies' => new Currency(),
                'modules' => Services::class,
                'paymentStatuses' => PaymentStatus::class,
                'paymentTypes' => PaymentMethods::class
            ]);
        }
    }
}
