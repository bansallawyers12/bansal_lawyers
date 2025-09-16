<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use App\Services\CspService;

class ContentSecurityPolicy
{
    public function handle(Request $request, Closure $next)
    {
        // Generate nonce early and make it available to views
        $nonce = CspService::generateNonce();
        
        $response = $next($request);
        
        // Only apply CSP to routes that need external resources
        if ($this->shouldApplyCSP($request)) {
            // Use the same nonce that was shared with views
            $csp = $this->buildCSP($request, $nonce);
            
            // Log CSP for debugging
            if (App::environment('local')) {
                \Log::info('=== CSP DEBUG START ===');
                \Log::info('CSP Nonce Generated: ' . $nonce);
                \Log::info('CSP Service Nonce: ' . (CspService::getNonce() ?? 'NULL'));
                \Log::info('CSP Applied: ' . $csp);
                \Log::info('=== CSP DEBUG END ===');
            }
            
            $response->headers->set('Content-Security-Policy', $csp);
            
            // Remove any existing report-only headers to avoid duplication
            $response->headers->remove('Content-Security-Policy-Report-Only');
        }
        
        return $response;
    }
    
    private function shouldApplyCSP(Request $request): bool
    {
        return $request->is('admin*') || 
               $request->is('contact*') || 
               $request->is('appointment*') ||
               $request->is('*recaptcha*');
    }
    
    private function buildCSP(Request $request, string $nonce): string
    {
        // Different CSP policies for different route types
        if ($request->is('admin*')) {
            // Strict CSP for admin routes with nonce support
            $policies = [
                "default-src 'self'",
                "script-src 'self' 'nonce-{$nonce}' https://www.google.com https://www.gstatic.com https://maps.googleapis.com",
                "style-src 'self' 'nonce-{$nonce}' https://fonts.googleapis.com https://cdnjs.cloudflare.com",
                "font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com",
                "img-src 'self' data: https: blob: https://www.google.com https://www.gstatic.com https://www.google-analytics.com",
                "connect-src 'self' https://www.google.com https://maps.googleapis.com https://www.google-analytics.com",
                "frame-src 'self' https://www.google.com",
                "object-src 'none'",
                "base-uri 'self'",
                "form-action 'self'",
                "frame-ancestors 'none'",
                "worker-src 'self' blob:",
                "child-src 'self' blob:",
                "manifest-src 'self'",
                "media-src 'self' data: blob:"
            ];
        } else {
            // More permissive CSP for frontend routes (contact, etc.)
            $policies = [
                "default-src 'self'",
                "script-src 'self' 'unsafe-inline' https://www.google.com https://www.gstatic.com https://maps.googleapis.com https://www.googletagmanager.com https://connect.facebook.net https://www.google-analytics.com",
                "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com",
                "font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com data:",
                "img-src 'self' data: https: blob: https://www.google.com https://www.gstatic.com https://www.google-analytics.com https://www.googletagmanager.com https://www.facebook.com https://www.google.com/recaptcha",
                "connect-src 'self' https://www.google.com https://maps.googleapis.com https://www.google-analytics.com https://www.googletagmanager.com https://connect.facebook.net https://www.google.com/recaptcha",
                "frame-src 'self' https://www.google.com https://www.facebook.com https://www.google.com/recaptcha",
                "object-src 'none'",
                "base-uri 'self'",
                "form-action 'self'",
                "frame-ancestors 'none'",
                "worker-src 'self' blob:",
                "child-src 'self' blob:",
                "manifest-src 'self'",
                "media-src 'self' data: blob:"
            ];
        }
        
        // Add specific policies for admin routes
        if ($request->is('admin*')) {
            $policies[] = "upgrade-insecure-requests";
        }
        
        // Add report URI if configured
        if (config('security.csp_reporting.enabled', false)) {
            $policies[] = 'report-uri ' . url(config('security.csp_reporting.endpoint', '/csp-report'));
        }
        
        return implode('; ', $policies);
    }
    
    private function generateNonce(): string
    {
        return base64_encode(random_bytes(16));
    }
}
