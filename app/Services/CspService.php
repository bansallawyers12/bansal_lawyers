<?php

namespace App\Services;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class CspService
{
    private static $nonce = null;
    
    /**
     * Generate and store CSP nonce for the current request
     * 
     * @return string
     */
    public static function generateNonce(): string
    {
        if (self::$nonce === null) {
            self::$nonce = base64_encode(random_bytes(16));
            
            // Make nonce available to all views (only if View facade is available)
            try {
                View::share('csp_nonce', self::$nonce);
            } catch (\Exception $e) {
                // View facade not available, skip
            }
            
            // Store in request for immediate access
            try {
                if (function_exists('request') && request()) {
                    request()->attributes->set('csp_nonce', self::$nonce);
                }
            } catch (\Exception $e) {
                // Request not available, skip
            }
        }
        
        return self::$nonce;
    }
    
    /**
     * Get the current CSP nonce
     * 
     * @return string|null
     */
    public static function getNonce(): ?string
    {
        if (self::$nonce === null) {
            // Try to get from view shared data (only if View facade is available)
            try {
                self::$nonce = view()->shared('csp_nonce');
            } catch (\Exception $e) {
                // View facade not available, skip
            }
        }
        
        if (self::$nonce === null) {
            try {
                if (function_exists('request') && request()) {
                    // Try to get from request attributes
                    self::$nonce = request()->attributes->get('csp_nonce');
                }
            } catch (\Exception $e) {
                // Request not available, skip
            }
        }
        
        return self::$nonce;
    }
    
    /**
     * Generate CSP nonce attribute for HTML tags
     * 
     * @return string
     */
    public static function getNonceAttribute(): string
    {
        $nonce = self::getNonce();
        return $nonce ? ' nonce="' . $nonce . '"' : '';
    }
    
    /**
     * Reset nonce (useful for testing)
     * 
     * @return void
     */
    public static function reset(): void
    {
        self::$nonce = null;
    }
}
