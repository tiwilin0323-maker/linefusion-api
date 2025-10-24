<?php

// 此檔案負責註冊與啟動金流模組的服務元件。

namespace App\Modules\Payment;

use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // 在此註冊金流模組所需的服務或綁定。
    }

    public function boot(): void
    {
        // 在此啟動金流模組相關的啟動邏輯。
    }
}
