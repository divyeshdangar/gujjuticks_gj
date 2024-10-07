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

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URL')
    ],

    'instagram' => [
        'INSTAGRAM_CLIENT_ID' => env('INSTAGRAM_CLIENT_ID'),
        'INSTAGRAM_CLIENT_SECRET' => env('INSTAGRAM_CLIENT_SECRET'),
        'INSTAGRAM_REDIRECT_URL' => env('INSTAGRAM_REDIRECT_URL'),
        'INSTAGRAM_HUB_VERIFY_TOKEN' => env('INSTAGRAM_HUB_VERIFY_TOKEN')
    ],

];
