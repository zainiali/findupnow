<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
     */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'message_central' => [
        'customer_id' => env('MESSAGE_CENTRAL_CUSTOMER_ID', 'C-A9BA0A28637A4CA'),
        'auth_token' => env('MESSAGE_CENTRAL_AUTH_TOKEN', 'eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJDLUE5QkEwQTI4NjM3QTRDQSIsImlhdCI6MTc2OTAwNDQyOSwiZXhwIjoxOTI2Njg0NDI5fQ.MmMyuWwNPlM8s4pxu6oTlUfi4_mvBL7YcjpK_aaipugw_dQBs0ySylPDf-T4sqn0vj9c0UdSEzKxHupTJOcgww'),
        // Sender ID is optional - leave empty if not available in your dashboard
        // Check: Settings > SMS Settings > Sender IDs, or contact Message Central support
        'sender_id' => env('MESSAGE_CENTRAL_SENDER_ID', null),
    ],

    'default_schema_string_length' => (int) env('DEFAULT_SCHEMA_STRING_LENGTH', 255),

    'default_status' => [
        'active_text' => 'active',
        'inactive_text' => 'inactive',
        'active_bool' => true,
        'inactive_bool' => false,
        'active_int' => 1,
        'inactive_int' => 0,
    ],
];
