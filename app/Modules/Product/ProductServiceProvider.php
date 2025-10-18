<?php

// 此檔案負責註冊與啟動商品模組的服務元件。

namespace App\Modules\Product;

use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // 在此註冊商品模組所需的服務或綁定。
    }

    public function boot(): void
    {
        // 在此啟動商品模組相關的啟動邏輯。
    }
}
