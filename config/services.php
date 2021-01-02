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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    // Laravel-Socialite Drivers
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => $_SERVER['HTTP_HOST'] == 'localhost' || 
                      $_SERVER['HTTP_HOST'] == 'libexams.local'
                    ? 'http://localhost/libexams/public/login/google/callback'
                    : 'http://' . $_SERVER['HTTP_HOST'] . '/login/google/callback',
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => $_SERVER['HTTP_HOST'] == 'localhost' || 
                      $_SERVER['HTTP_HOST'] == 'libexams.local'
                    ? 'http://localhost/libexams/public/login/facebook/callback'
                    : 'https://' . $_SERVER['HTTP_HOST'] . '/login/facebook/callback',
    ],

    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect' => $_SERVER['HTTP_HOST'] == 'localhost' || 
                      $_SERVER['HTTP_HOST'] == 'libexams.local'
                    ? 'http://localhost/libexams/public/login/github/callback'
                    : 'https://' . $_SERVER['HTTP_HOST'] . '/login/github/callback',
    ],

];
