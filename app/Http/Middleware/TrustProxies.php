<?php

// 此檔案負責設定受信任的代理伺服器與相關標頭。

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    protected $proxies;

    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
