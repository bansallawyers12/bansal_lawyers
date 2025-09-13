<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // Get security headers from configuration
        $headers = config('security.headers', []);
        
        // Apply security headers
        foreach ($headers as $header => $value) {
            if ($value) {
                $response->headers->set($this->formatHeaderName($header), $value);
            }
        }
        
        // Add additional security headers for admin routes
        if ($request->is('admin*')) {
            $this->addAdminSpecificHeaders($response);
        }
        
        return $response;
    }
    
    private function addAdminSpecificHeaders($response): void
    {
        // Additional headers for admin area
        $response->headers->set('X-Robots-Tag', 'noindex, nofollow');
        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');
    }
    
    private function formatHeaderName(string $header): string
    {
        // Convert snake_case to Header-Name format
        return str_replace('_', '-', ucwords($header, '_'));
    }
}
