<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

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
            // Log the locale value from the session
    \Log::info('Locale in session: ' . Session::get('locale', 'en'));

    // Set the locale globally
    App::setLocale(Session::get('locale', 'en'));

    // Log the locale applied to the application
    \Log::info('Locale applied: ' . App::getLocale());
    }
}
