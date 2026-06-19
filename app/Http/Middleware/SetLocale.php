<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('locale', 'ne');
        if ($locale === 'ne') {
            App::setLocale('np');
        } else {
            App::setLocale('en');
        }

        return $next($request);
    }
}