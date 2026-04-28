<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'stripe' => [
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    
    //Add these Configurations
    'recaptcha' => [
        'key' => env('RECAPTCHA_SITE_KEY'),
        'secret' => env('RECAPTCHA_SITE_SECRET'),
    ],

    'google_analytics' => [
        'id' => env('GOOGLE_ANALYTICS_ID'),
        'gtm_id' => env('GOOGLE_TAG_MANAGER_ID'),
    ],

    'twilio' => [
        'sid' => env('TWILIO_SID'),
        'token' => env('TWILIO_TOKEN'),
        'from' => env('TWILIO_FROM'),
    ],

    /*
    | Shared secret for GET /api/appointments (Bearer or X-Appointments-Api-Token header).
    */
    'appointments_api' => [
        'token' => env('APPOINTMENTS_API_TOKEN'),
    ],

    /*
    | Sync successful website appointment bookings to Bansal CRM.
    | Defaults target legal.bansalcrm.com; override with CRM_LEAD_POST_URL / CRM_BOOKING_POST_URL (e.g. local WAMP).
    | Set CRM_LEAD_POST_URL empty to disable outbound calls.
    | Optional CRM_API_TOKEN sends Authorization: Bearer on both CRM requests.
    */
    'crm_lead' => [
        'url' => env('CRM_LEAD_POST_URL'),
        'booking_url' => env('CRM_BOOKING_POST_URL'),
        'disabled_time_slots_url' => env('CRM_DISABLED_TIME_SLOTS_URL'),
        'disabled_time_slots_timeout' => max(1.0, (float) env('CRM_DISABLED_TIME_SLOTS_TIMEOUT', 5)),
        'disabled_time_slots_use_token' => filter_var(env('CRM_DISABLED_TIME_SLOTS_USE_TOKEN'), FILTER_VALIDATE_BOOL),
        'verify_ssl' => filter_var(env('CRM_HTTP_VERIFY_SSL'), FILTER_VALIDATE_BOOL),
        'api_token' => env('CRM_API_TOKEN'),
        'country_code' => env('CRM_LEAD_COUNTRY_CODE'),
        'source' => env('CRM_LEAD_SOURCE'),
        'lead_status' => env('CRM_LEAD_LEAD_STATUS'),
        'location' => env('CRM_BOOKING_LOCATION'),
        'consultant_id' => env('CRM_BOOKING_CONSULTANT_ID'),
        'crm_service_id' => env('CRM_BOOKING_CRM_SERVICE_ID'),
        'meeting_type' => env('CRM_BOOKING_MEETING_TYPE'),
        'default_timezone' => env('CRM_BOOKING_TIMEZONE'),
        'default_duration' => env('CRM_BOOKING_DEFAULT_DURATION'),
    ],

];
