<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Define sensitive headers to be removed
        $sensitieveHeaders = [
            'authorization',
            'cookie',
            'set-cookie',
            'proxy-authorization',
            'x-csrf-token',
            'x-api-key',
            'x-secret-key'
        ];

        // Get all headers from the request
        $headers = $request->headers->all();

        // Remove sensitive headers
        foreach ($sensitieveHeaders as $header) {
            if (isset($headers[$header])) {
                unset($headers[$header]);
            }
        }
        
        Log::channel('request-headers')
            ->info('Request Headers:', $headers);

        return $next($request);
    }
}
