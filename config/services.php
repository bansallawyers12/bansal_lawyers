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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    
    'facebook' => [
        'client_id'     => env('FB_ID'),
        'client_secret' => env('FB_SECRET'),
        'redirect'      => env('FB_URL'),
    ],

    'google' => [
        'client_id'     => env('GOOGLE_ID'),
        'client_secret' => env('GOOGLE_SECRET'),
        'redirect'      => env('GOOGLE_URL'),
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
        'url' => env('CRM_LEAD_POST_URL', 'https://legal.bansalcrm.com/api/leads'),
        'booking_url' => env('CRM_BOOKING_POST_URL', 'https://legal.bansalcrm.com/api/booking-appointments'),
        /** POST; same as CRM /api/appointments/get-booked-disabled-time-slots. Empty URL skips merge. */
        'disabled_time_slots_url' => env('CRM_DISABLED_TIME_SLOTS_URL', 'https://legal.bansalcrm.com/api/appointments/get-booked-disabled-time-slots'),
        /** Public CRM route: false avoids sending CRM_API_TOKEN (some servers return 401 for wrong Bearer). */
        'disabled_time_slots_use_token' => filter_var(env('CRM_DISABLED_TIME_SLOTS_USE_TOKEN', false), FILTER_VALIDATE_BOOL),
        /** Set false on dev machines with broken PHP CA bundle (SSL errors in laravel.log). */
        'verify_ssl' => filter_var(env('CRM_HTTP_VERIFY_SSL', true), FILTER_VALIDATE_BOOL),
        'api_token' => env('CRM_API_TOKEN'),
        'country_code' => env('CRM_LEAD_COUNTRY_CODE', '+61'),
        'source' => env('CRM_LEAD_SOURCE', 'Website form'),
        'lead_status' => env('CRM_LEAD_LEAD_STATUS', 'new'),
        'location' => env('CRM_BOOKING_LOCATION', 'melbourne'),
        /** Website bookings default to consultant 2; override with CRM_BOOKING_CONSULTANT_ID. */
        'consultant_id' => env('CRM_BOOKING_CONSULTANT_ID', 2),
        'crm_service_id' => env('CRM_BOOKING_CRM_SERVICE_ID', 2),
        'meeting_type' => env('CRM_BOOKING_MEETING_TYPE', 'in_person'),
        'default_timezone' => env('CRM_BOOKING_TIMEZONE', 'Australia/Sydney'),
        'default_duration' => env('CRM_BOOKING_DEFAULT_DURATION', 30),
        ],

];
