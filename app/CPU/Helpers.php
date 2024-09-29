<?php

namespace App\CPU;

use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Auth;

class Helpers
{
    public static function percentage($total, $value)
    {
        return ($total > 0) ? round(($value / $total) * 100) : 0;
    }

    public static function logout($guard)
    {
        try {

            Auth::guard($guard)->logout();
            return 'Logged Out';

        } catch (Exception $e) {

            return $e->getMessage();
        }
    }

    public function profile($guard)
    {
        return Auth::guard($guard)->user();
    }


    // public static function make_online()
    // {
    //     $active = Auth::guard('api_users')->user();
    //     $active->last_seen = Carbon::now();
    //     $active->save();
    // }

    // public static function getPaginateSetting()
    // {
    //     if (session()->has('paginate')) {
    //         return session('paginate');
    //     } else {
    //         $setting = AppSetting::where('key', 'paginate')->first();
    //         if ($setting) {
    //             session(['paginate' => $setting->value]);
    //             return $setting->value;
    //         }
    //         return null; // or a default value
    //     }
    // }

    // public static function getAppLogoSetting()
    // {
    //     if (session()->has('app_logo')) {
    //         return asset('storage/images/settings/' . session('app_logo'));
    //     } else {
    //         $setting = AppSetting::where('key', 'app_logo')->first();
    //         if ($setting) {
    //             session(['app_logo' => $setting->value]);
    //             return asset('storage/images/settings/' . $setting->value);
    //         }
    //         return null; // or a default image path
    //     }
    // }


    // public static function getEnvCredentials()
    // {
    //     $envCredentials = Session::get('env_credentials');

    //     if (!$envCredentials) {
    //         // Fetch credentials from the database
    //         $envCredentials = AppSetting::whereIn('key', [
    //             'MAIL_DRIVER',
    //             'MAIL_HOST',
    //             'MAIL_PORT',
    //             'MAIL_USERNAME',
    //             'MAIL_PASSWORD',
    //             'MAIL_ENCRYPTION',
    //             'PUSHER_APP_ID',
    //             'PUSHER_APP_KEY',
    //             'PUSHER_APP_SECRET',
    //             'PUSHER_APP_CLUSTER',
    //         ])->pluck('value', 'key')->toArray();

    //         if (empty($envCredentials)) {
    //             // If credentials are still empty, fetch from environment variables
    //             $envCredentials = [
    //                 'MAIL_DRIVER' => env('MAIL_DRIVER'),
    //                 'MAIL_HOST' => env('MAIL_HOST'),
    //                 'MAIL_PORT' => env('MAIL_PORT'),
    //                 'MAIL_USERNAME' => env('MAIL_USERNAME'),
    //                 'MAIL_PASSWORD' => env('MAIL_PASSWORD'),
    //                 'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),
    //                 'PUSHER_APP_ID' => env('PUSHER_APP_ID'),
    //                 'PUSHER_APP_KEY' => env('PUSHER_APP_KEY'),
    //                 'PUSHER_APP_SECRET' => env('PUSHER_APP_SECRET'),
    //                 'PUSHER_APP_CLUSTER' => env('PUSHER_APP_CLUSTER'),
    //             ];
    //         }

    //         // Set credentials in session
    //         Session::put('env_credentials', $envCredentials);
    //     }

    //     return $envCredentials;
    // }
    // public static function updateEnvCredentials($key, $value)
    // {
    //     $envCredentials = Session::get('env_credentials');

    //     if ($envCredentials && array_key_exists($key, $envCredentials)) {
    //         $envCredentials[$key] = $value;
    //         Session::put('env_credentials', $envCredentials);
    //         // Update the .env file
    //         $envFile = base_path('.env');
    //         if (file_exists($envFile)) {
    //             file_put_contents($envFile, preg_replace(
    //                 "/^$key=.*\$/m",
    //                 "$key=$value",
    //                 file_get_contents($envFile)
    //             ));
    //         }
    //     }
    // }
}
