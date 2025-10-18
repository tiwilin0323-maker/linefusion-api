<?php

// 此檔案負責註冊與啟動核心模組的共用服務元件。

namespace App\Modules\Core;

use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // 在此註冊核心模組所需的服務或綁定。
    }

    public function boot(): void
    {
        // 在此啟動核心模組相關的啟動邏輯。
    }
}
