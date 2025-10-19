<?php

// 此檔案設定視圖檔案的搜尋路徑與編譯快取位置。

return [
    'paths' => [
        resource_path('views'),
    ],

    'compiled' => env('VIEW_COMPILED_PATH', realpath(storage_path('framework/views'))),
];
