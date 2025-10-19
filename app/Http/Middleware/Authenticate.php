<?php

// 此檔案負責處理未驗證使用者的導向邏輯。

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        return null;
    }
}
