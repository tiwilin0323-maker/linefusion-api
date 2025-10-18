<?php

// 此檔案負責設定 CSRF 驗證例外路徑以保護應用程式。

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        'api/*',
    ];
}
