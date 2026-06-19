<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
   public function handle(Request $request, Closure $next): Response
{
    // Debug: Check if session is working
    // dd(session()->all()); 

    if (session()->has('locale')) {
        App::setLocale(session()->get('locale'));
    } else {
        App::setLocale('np');
    }

    return $next($request);
}
}