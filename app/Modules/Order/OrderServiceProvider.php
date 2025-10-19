<?php

// 此檔案負責註冊與啟動訂單模組的服務元件。

namespace App\Modules\Order;

use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // 在此註冊訂單模組所需的服務或綁定。
    }

    public function boot(): void
    {
        // 在此啟動訂單模組相關的啟動邏輯。
    }
}
