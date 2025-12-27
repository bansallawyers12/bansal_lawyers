<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */ 
    protected $except = [
        // Only exclude API routes and webhook endpoints that legitimately need CSRF bypass
		'api/*',
		// CSP violation reporting endpoint (browsers send reports automatically without CSRF tokens)
		'csp-report',
		// Note: All admin endpoints now require CSRF protection for security
    ];
}
