<?php

// 此檔案定義提供給前端與外部服務使用的 API 路由。

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/health', fn () => response()->json(['status' => 'ok']));
});
