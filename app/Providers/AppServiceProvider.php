<?php

namespace App\Providers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (!file_exists(public_path('storage'))) {
            try {
                // Call artisan command to create symbolic link
                Artisan::call('storage:link');
            } catch (\Exception $e) {
                // Handle any exceptions if the command fails
                Log::error('Error occurred while linking storage: ' . $e->getMessage());
            }
        }
        $this->configureRateLimiting();
        $this->fetchAndStoreUserLocation();
    }


    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    public function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
    protected function fetchAndStoreUserLocation()
    {

        // $ip = request()->ip() == '127.0.0.1' ? '221.120.227.235' : request()->ip();
        $ip = request()->ip()=='127.0.0.1'?'27.147.191.221':request()->ip();
        // $ip='221.120.227.235';
        // dd($ip); 
        if (!Session::has('user_country') || !Session::has('user_city')|| (Session::get('ip')!=$ip)) {
            // Get the user's IP address
            // Fetch location data

            $location = Location::get($ip);

            if ($location) {
                $country = $location->countryName;
                $city = $location->cityName;
                $currencyCode = (string) @$location->currencyCode;
                if (!Session::has('currency_id')) {

                    $currency = Currency::where('status', 1)->where('code', $currencyCode)->select('id')->first();
                    if (isset($currency)) {
                        Session::put('currency_id', $currency->id);
                        Session::put('currency_code', $currencyCode??"USD");
                    }
                }
                Session::put('country_flag', 'https://flagsapi.com/' . $location->countryCode . '/flat/64.png');
                Session::put('user_country', $country);
                Session::put('user_city', $city);
                Session::put('ip', $ip);
            }
        }
    }
}
