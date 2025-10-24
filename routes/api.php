<?php

// 此檔案定義提供給前端與外部服務使用的 API 路由。

use App\Http\Controllers\Api\V1\SystemController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/health', [SystemController::class, 'health']);
    Route::get('/system/version', [SystemController::class, 'version']);
});
