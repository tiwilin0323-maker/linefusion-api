<?php

// 此檔案設定 Laravel Sanctum 的狀態化網域與相關參數。

return [
    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', 'localhost')), 
    'guard' => ['web'],
    'expiration' => env('SANCTUM_EXPIRATION'),
    'token_prefix' => env('SANCTUM_TOKEN_PREFIX', ''),
    'middleware' => [
        'verify_csrf_token' => App\Http\Middleware\VerifyCsrfToken::class,
        'encrypt_cookies' => App\Http\Middleware\EncryptCookies::class,
    ],
];
