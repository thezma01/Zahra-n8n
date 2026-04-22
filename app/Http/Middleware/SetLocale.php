<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1);

        if (in_array($locale, Config::get('app.available_locales'))) {
            App::setLocale($locale);
        } else {
            // If no locale in URL, or unsupported, use default and continue.
            // Note: Route::redirect('/', '/'.config('app.locale'), 302); in web.php
            // should handle initial redirection for root.
            App::setLocale(Config::get('app.locale'));
        }

        return $next($request);
    }
}
