<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // Get the locale from session and set it
        App::setLocale(Session::get('locale', 'en'));

        // Log the applied locale for debugging
        \Log::info('Middleware Locale: ' . App::getLocale());

        return $next($request);
    }
}
