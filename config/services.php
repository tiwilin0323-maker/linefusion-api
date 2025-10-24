<?php

// 此檔案設定外部服務（如藍新金流與 LINE）的整合參數。

return [
    'newebpay' => [
        'merchant_id' => env('NEWEBPAY_MERCHANT_ID'),
        'hash_key' => env('NEWEBPAY_HASH_KEY'),
        'hash_iv' => env('NEWEBPAY_HASH_IV'),
        'notify_url' => env('NEWEBPAY_NOTIFY_URL'),
        'return_url' => env('NEWEBPAY_RETURN_URL'),
    ],

    'line' => [
        'channel_id' => env('LINE_CHANNEL_ID'),
        'channel_secret' => env('LINE_CHANNEL_SECRET'),
        'channel_access_token' => env('LINE_CHANNEL_ACCESS_TOKEN'),
    ],
];
