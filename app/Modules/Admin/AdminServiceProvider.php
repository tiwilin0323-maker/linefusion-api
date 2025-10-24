<?php

// 此檔案負責註冊與啟動後台模組的服務元件。

namespace App\Modules\Admin;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // 在此註冊後台模組所需的服務或綁定。
    }

    public function boot(): void
    {
        // 在此啟動後台模組相關的啟動邏輯。
    }
}
