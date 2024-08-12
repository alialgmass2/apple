<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;
use Log;
use Symfony\Component\HttpFoundation\Response;

class PreventBackButtonMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $response->headers->set("Cache-Control" ,"no-cache, no-store, must-revalidate"); // HTTP 1.1.
        $response->headers->set("Pragma"," no-cache"); // HTTP 1.0.
        $response->headers->set("Expires","0"); // Proxies.

        // $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        // $response->headers->set('Pragma', 'no-cache');
        // $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
        Log::info('PREVENT BACK HISTPRY MIDDLEWARE');
        return $response;

    }
}
