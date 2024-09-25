<?php

namespace App\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

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
                \Log::error('Error occurred while linking storage: ' . $e->getMessage());
            }
        }
    }
}
