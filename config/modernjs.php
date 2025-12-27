<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Modern JavaScript Migration Feature Flags
    |--------------------------------------------------------------------------
    |
    | These flags control the gradual migration from jQuery to modern JavaScript.
    | Set to true to enable modern implementation, false to use legacy jQuery.
    |
    */

    // Master switch - set to true to enable all modern JS features
    'enabled' => env('USE_MODERN_JS', false),

    // Individual feature flags for granular control
    'features' => [
        // Phase 2: Native forEach instead of jQuery .each()
        'native_foreach' => env('MODERN_JS_FOREACH', false),
        
        // Phase 3: domUtils for simple DOM manipulation
        'dom_utils' => env('MODERN_JS_DOM_UTILS', false),
        
        // Phase 4: Axios/ajaxUtils for AJAX calls
        'ajax_utils' => env('MODERN_JS_AJAX', false),
        
        // Phase 5: Alpine.js for complex DOM manipulation
        'alpine_js' => env('MODERN_JS_ALPINE', false),
        
        // Phase 6: Modern form validation
        'form_validation' => env('MODERN_JS_VALIDATION', false),
    ],

    // Page-specific overrides (useful for testing one page at a time)
    'pages' => [
        'admin_blog' => env('MODERN_JS_ADMIN_BLOG', false),
        'admin_cms' => env('MODERN_JS_ADMIN_CMS', false),
        'admin_appointments' => env('MODERN_JS_ADMIN_APPOINTMENTS', false),
        'appointment_booking' => env('MODERN_JS_APPOINTMENT_BOOKING', false),
        'contact_form' => env('MODERN_JS_CONTACT', false),
    ],

    // Debug mode - logs migration status
    'debug' => env('MODERN_JS_DEBUG', false),
];

