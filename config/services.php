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
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        'client_id' =>'569659996092-1odtmmj8jsb38u1crha1nb7v75phh00u.apps.googleusercontent.com',
        'client_secret' =>'pmKR9NwZKTjBD6ZVQFbwFZmm',
        'redirect' => 'http://www.cdcnepal.com.np/login/google/callback',
        //

    ],

    'facebook' => [
        'client_id' => '1705304502893261',
        'client_secret' => '4d13ff38837ea1c8cf5b12d53cf9d4f0',
        'redirect' => 'https://www.cdcnepal.com.np/login/facebook/callback',
    ],
];
