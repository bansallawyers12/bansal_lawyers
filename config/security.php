<?php

return [
    'csp' => [
        'enabled' => env('CSP_ENABLED', true),
        'report_uri' => env('CSP_REPORT_URI'),
        'policies' => [
            'default-src' => ["'self'"],
            'script-src' => [
                "'self'",
                "'unsafe-inline'",
                "'unsafe-eval'",
                'https://www.google.com',
                'https://www.gstatic.com',
                'https://maps.googleapis.com'
            ],
            'style-src' => [
                "'self'",
                "'unsafe-inline'",
                'https://cdnjs.cloudflare.com'
            ],
            'font-src' => [
                "'self'",
                'https://cdnjs.cloudflare.com'
            ],
            'img-src' => [
                "'self'",
                'data:',
                'https:',
                'blob:',
                'https://www.google.com'
            ],
            'connect-src' => [
                "'self'",
                'https://www.google.com',
                'https://maps.googleapis.com'
            ],
            'frame-src' => [
                "'self'",
                'https://www.google.com'
            ],
            'object-src' => ["'none'"],
            'base-uri' => ["'self'"],
            'form-action' => ["'self'"],
            'frame-ancestors' => ["'none'"]
        ]
    ],
    
    'headers' => [
        'x_content_type_options' => 'nosniff',
        'x_frame_options' => 'DENY',
        'x_xss_protection' => '1; mode=block',
        'referrer_policy' => 'strict-origin-when-cross-origin',
        'permissions_policy' => 'geolocation=(), microphone=(), camera=(), payment=(), usb=(), magnetometer=(), gyroscope=(self), accelerometer=(self), autoplay=(self), encrypted-media=(self), picture-in-picture=(self)',
        'x_permitted_cross_domain_policies' => 'none',
        'strict_transport_security' => env('APP_ENV') === 'production' ? 'max-age=31536000; includeSubDomains; preload' : 'max-age=0'
    ],
    
    'admin_headers' => [
        'x_robots_tag' => 'noindex, nofollow, nosnippet, noarchive',
        'cache_control' => 'no-cache, no-store, must-revalidate, private',
        'pragma' => 'no-cache',
        'expires' => '0'
    ],
    
    'csp_reporting' => [
        'enabled' => env('CSP_REPORTING_ENABLED', true),
        'endpoint' => env('CSP_REPORT_ENDPOINT', '/csp-report'),
        'sample_rate' => env('CSP_REPORT_SAMPLE_RATE', 0.1)
    ],
    
    'monitoring' => [
        'enabled' => env('SECURITY_MONITORING_ENABLED', true),
        'log_violations' => env('LOG_CSP_VIOLATIONS', true),
        'alert_threshold' => env('CSP_ALERT_THRESHOLD', 10)
    ]
];
