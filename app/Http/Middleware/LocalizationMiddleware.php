<?php

namespace App\Http\Middleware;

use Closure;
use Log;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Log::info(Session::get('appLocale'));
        
        if (Session::has('appLocale')) {
            App::setLocale(Session::get('appLocale'));
        }
        else { // This is optional as Laravel will automatically set the fallback language if there is none specified
            App::setLocale(Config::get('app.fallback_locale'));
        }
        // app()->setLocale('\Session::get('locale')');
        // app()->setLocale('fr');

        
        return $next($request);
    }
}
