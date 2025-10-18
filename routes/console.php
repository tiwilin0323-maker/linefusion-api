<?php

// 此檔案註冊 Artisan 主控台路由與自訂指令。

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('顯示激勵人心的語錄');
