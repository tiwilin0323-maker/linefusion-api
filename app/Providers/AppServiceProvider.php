<?php

// 此檔案負責在應用程式啟動時註冊共用服務與模組提供者。

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        foreach (config('modules.providers', []) as $provider) {
            if (class_exists($provider)) {
                $this->app->register($provider);
            }
        }
    }

    public function boot(): void
    {
        // 在此放置應用程式啟動時需要執行的額外邏輯。
    }
}
