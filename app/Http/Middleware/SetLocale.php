<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
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
        // Priority: 1. Session, 2. Authenticated user, 3. Default (ja)
        $locale = Session::get('locale');
        
        if (!$locale && auth()->check()) {
            $locale = auth()->user()->locale;
            Session::put('locale', $locale);
        }
        
        if (!$locale) {
            $locale = 'ja'; // Default to Japanese
        }
        
        App::setLocale($locale);
        
        return $next($request);
    }
}
