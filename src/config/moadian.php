<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Moadian Package Mode
    |--------------------------------------------------------------------------
    |
    | This determines the mode of operation for the Moadian package:
    |
    | false (default): Single-user mode - Uses credentials from .env file
    |                  and registers a singleton instance accessible via facade
    |
    | true: Multi-user mode - Each user has their own credentials stored in database
    |       Facade throws exception, must use Moadian::forUser($userId) instead
    |
    */

    'multi_moadi' => env('MOADIAN_MULTI_MOADI', false),

    /*
    |--------------------------------------------------------------------------
    | Default Moadian Credentials
    |--------------------------------------------------------------------------
    |
    | These are the default credentials used when no specific user
    | credentials are provided. You can still override these by using
    | the multi-user functionality.
    |
    */

    'username' => env('MOADIAN_USERNAME'),
    'private_key_path' => env('MOADIAN_PRIVATE_KEY_PATH', 'private/app/keys/private.pem'),
    'certificate_path' => env('MOADIAN_CERTIFICATE_PATH', 'private/app/keys/certificate.crt'),
    'base_url' => env('MOADIAN_API_URL', 'https://tp.tax.gov.ir/requestsmanager/api/v2/'),

    /*
    |--------------------------------------------------------------------------
    | Multi-User Settings
    |--------------------------------------------------------------------------
    |
    | When multi_moadi is enabled, the package will work in multi-user mode
    | and won't register the default singleton instance. Instead, you'll need
    | to use Moadian::forUser() or create instances manually.
    |
    */

    'multi_moadi_settings' => [
        'user_model' => env('MOADIAN_USER_MODEL', 'App\Models\User'),
        'user_table' => 'users',
    ],
];