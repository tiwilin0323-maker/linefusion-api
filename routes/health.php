<?php

// 此檔案定義系統健康檢查端點的路由。

use Illuminate\Support\Facades\Route;

Route::get('/up', fn () => response()->json(['status' => 'ok']));
