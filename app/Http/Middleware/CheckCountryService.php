<?php

namespace App\Http\Middleware;

use App\Enums\Services;
use App\Enums\Status;
use App\Models\Services\Service;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCountryService
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $module): Response {
        // Check if the service is active at all on the platform
        if(!$service = Service::isActive()->where('shortcode', $module)->first()) {
            if(!$service = Service::where('shortcode', $module)->first()){
                toast('The selected service module was invalid! Please contact our support center!', 'Invalid Service Selected')->error();
            }else{
                toast($service->name.' is not available at the moment! For more information, please contact our support center', $service->name.'Service Unavailable')->error();
            }

            return redirect(RouteServiceProvider::HOME);
        }

        $user = $request->user();

        // Check if the service is active and available in the current user's country
        if(!$service->countries()->where([
            'country_code' => $user->country_code,
            'country_services.status' => Status::ACTIVE
        ])->first()) {
            toast($service->name.' is not available in your country at the moment! For more information, please contact our support center', $service->name.' Service is unavailable in your country')->error();
            return redirect(RouteServiceProvider::HOME);
        }

        // Check if the service has active products with service providers which are available in the current user's country
        // If there is no service provider set up for the user's country, the service should not be accessible to the user
        $products = $service->products()->where('country_code', $user->country_code)->isActive('service_products.status')->whereHas('provider', function($query) use($user) {
            $query->isActive('status')->whereHas('providerCountries', fn($query) => $query->where('country_code', $user->country_code));
        })->exists();

        if(!$products) {
            toast($service->name.' is not available because no service provider has been set up for your country! Please contact our support center', $service->name.' Service is unavailable in your country')->error();
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
