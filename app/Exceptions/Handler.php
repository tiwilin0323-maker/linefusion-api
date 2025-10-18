<?php

// 此檔案負責處理應用程式的例外狀況與錯誤回報邏輯。

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // 可在此加入額外的例外通報或記錄機制。
        });
    }
}
