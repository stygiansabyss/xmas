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
    ],
    
    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],
    
    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
    
    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'stream-labs' => [
        'access_token'  => env('STREAM_LABS_TOKEN'),
        'client_id'     => env('STREAM_LABS_KEY'),
        'client_secret' => env('STREAM_LABS_SECRET'),
        'redirect'      => env('STREAM_LABS_REDIRECT_URI'),
        'alert_channel' => env('STREAM_LABS_ALERT_CHANNEL'),
    ],
];
