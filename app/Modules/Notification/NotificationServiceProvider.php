<?php

// 此檔案負責註冊與啟動通知模組的服務元件。

namespace App\Modules\Notification;

use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // 在此註冊通知模組所需的服務或綁定。
    }

    public function boot(): void
    {
        // 在此啟動通知模組相關的啟動邏輯。
    }
}
