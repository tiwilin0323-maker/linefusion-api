<?php

// 此檔案定義建立 password_reset_tokens 資料表的資料庫遷移。

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 若資料表已存在則不重複建立。
        if (Schema::hasTable('password_reset_tokens')) {
            return;
        }

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email', 255)->primary()->comment('電子郵件作為主鍵');
            $table->string('token')->comment('重設密碼 Token');
            $table->timestamp('created_at')->nullable()->comment('建立時間');

            $table->comment('密碼重設 Token 資料表');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};
