<?php

// 此檔案負責註冊事件監聽器與訂閱者設定。

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [];
}
