<?php

// 此檔案負責管理應用程式 Cookie 的加密與排除設定。

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    protected $except = [];
}
