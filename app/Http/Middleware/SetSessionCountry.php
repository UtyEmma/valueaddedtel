<?php

namespace App\Http\Middleware;

use App\Services\CountryService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\View\Factory;

class SetSessionCountry {

    public function __construct(
        private Factory $factory
    ) { }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        $country = (new CountryService)->set();

        if($country){
            $this->factory->share('currentCountry', $country);
            $this->factory->share('currentCurrency', $country->currency);
        }

        return $next($request);
    }
}
