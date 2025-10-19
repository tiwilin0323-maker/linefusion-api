<?php

// 此檔案提供應用程式層級的共用輔助函式。

if (! function_exists('app_version')) {
    function app_version(): string
    {
        // 取得應用程式的版本編號設定。
        return trim((string) config('app.version', '0.1.0'));
    }
}
