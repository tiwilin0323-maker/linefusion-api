<?php

// 此檔案負責註冊與啟動身分驗證模組的服務元件。

namespace App\Modules\Auth;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // 在此註冊驗證模組所需的服務或綁定。
    }

    public function boot(): void
    {
        // 在此啟動驗證模組相關的啟動邏輯。
    }
}
