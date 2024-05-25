<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddCSP
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $response->header('Content-Security-Policy', 'default-src \'none\'; connect-src \'self\'; style-src \'unsafe-inline\' https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css; script-src \'self\' https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js https://webhook.site/2332aa04-306b-4d79-ac5f-5e8b27dbc056/test_api; object-src \'none\'');
        return $response;
    }
}
