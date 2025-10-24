<?php

// 此檔案設定應用程式的檔案系統磁碟與連結。

return [
    'default' => env('FILESYSTEM_DISK', 'local'),

    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        'azure' => [
            'driver' => 'azure',
            'name' => env('AZURE_STORAGE_NAME'),
            'key' => env('AZURE_STORAGE_KEY'),
            'container' => env('AZURE_STORAGE_CONTAINER'),
            'url' => env('AZURE_STORAGE_URL'),
        ],
    ],

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],
];
