<?php

use App\CPU\Helpers;
use App\Models\Currency;
use App\Models\HomepageSettings;
use App\Models\ConfigurationSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

if (!function_exists('get_setting')) {
    function get_settings($key, $default = null)
    {
        if (Session::has('settings.' . $key)) {
            return Session::get('settings.' . $key, $default);
        }

        $setting = ConfigurationSetting::where('type', $key)->first();

        if ($setting !== null) {
            Session::put('settings.' . $key, $setting->value);
            return $setting->value;
        }

        return $default;
    }
}

// HomepageSettings
if (!function_exists('homepage_setting')) {
    function homepage_setting($key)
    {
        if (Session::has('homepage_setting.' . $key)) {
            
            return Session::get('homepage_setting.' . $key);
        }

        $settings = HomepageSettings::first();

        if ($settings) {
            $data = [
                "bannerSection" => $settings->bannerSection,
                "sliderSection" => $settings->sliderSection,
                "midBanner" => $settings->midBanner,
                "dealOfTheDay" => $settings->dealOfTheDay,
                "trending" => $settings->trending,
                "brands" => $settings->brands,
                "popular&featured" => $settings->popularANDfeatured,
                "newslatter" => $settings->newslatter,
                "last_updated_by" => Helpers::adminName($settings->last_updated_by),
                "last_updated_at" => $settings->updated_at,
            ];

            foreach ($data as $k => $setting) {
                Session::put('homepage_setting.' . $k, $setting);
            }

            return Session::get('homepage_setting.' . $key);
        } else {
            $new = new HomepageSettings();
            $new->last_updated_by = Auth::guard('admin')->id();
            $new->save();

            return false; 
        }

        return false; 
    }
}


// format date
if (!function_exists('get_system_date')) {
    function get_system_date($date)
    {

        $dateObj = Carbon\Carbon::parse($date);
        $dateObj->setTimezone(get_settings('system_timezone'));

        $dateFormat = get_settings('system_date_format') ?? 'Y-m-d';

        if ($dateFormat) {
            return $dateObj->format($dateFormat);
        } else {
            return $dateObj->format('Y-m-d');
        }
    }
}

// format time
if (!function_exists('get_system_time')) {
    function get_system_time($time, $timezone = null)
    {
        $dateObj = Carbon\Carbon::parse($time);

        if ($timezone) {
            $dateObj->setTimezone($timezone);
        } else {
            $dateObj->setTimezone(get_settings('system_timezone') ?? config('app.system_default_timezone'));
        }

        $timeFormat = get_settings('system_time_format') ?? 'H:i:s A';

        return $dateObj->format($timeFormat);
    }
}

if (!function_exists('tz_list')) {
    function tz_list()
    {
        $zones_array = array();
        $timestamp = time();
        foreach (timezone_identifiers_list() as $key => $zone) {
            date_default_timezone_set($zone);
            $zones_array[$key]['zone'] = $zone;
            $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
        }
        return $zones_array;
    }
}

//formats currency
if (!function_exists('format_price')) {
    function format_price($price, $isMinimize = false)
    {
        if (get_settings('system_decimal_separator') == 1) {
            $format_price = number_format($price, get_settings('system_no_of_decimals'));
        } else {
            $format_price = number_format($price, get_settings('system_no_of_decimals'), ',', '.');
        }

        // Minimize the price 
        if ($isMinimize) {
            $temp = number_format($price / 1000000000, get_settings('system_no_of_decimals'), ".", "");

            if ($temp >= 1) {
                $format_price = $temp . "B";
            } else {
                $temp = number_format($price / 1000000, get_settings('system_no_of_decimals'), ".", "");
                if ($temp >= 1) {
                    $format_price = $temp . "M";
                }
            }
        }

        if (get_settings('system_symbol_format') == '[Symbol][Amount]') {
            return currency_symbol() . $format_price;
        } else if (get_settings('system_symbol_format') == "[Symbol] [Amount]") {
            return currency_symbol() . ' ' . $format_price;
        } else if (get_settings('system_symbol_format') == "[Amount] [Symbol]") {
            return $format_price . ' ' . currency_symbol();
        }

        return $format_price . currency_symbol();
    }
}

//gets currency symbol
if (!function_exists('currency_symbol')) {
    function currency_symbol()
    {
        if (Session::has('system_default_currency')) {
            return Session::get('system_default_currency');
        }

        return get_system_default_currency();
    }
}

if (!function_exists('get_system_default_currency')) {
    function get_system_default_currency()
    {
        $currency = Currency::find(get_settings('system_default_currency'));
        if ($currency) {
            $currency_symbol = $currency->symbol;
        } else {
            $currency_symbol = '£';
        }
        return $currency_symbol;
    }
}
