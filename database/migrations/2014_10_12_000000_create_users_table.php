<?php

// 此檔案定義建立 users 資料表的資料庫遷移。

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 若資料表已存在則不重複建立。
        if (Schema::hasTable('users')) {
            return;
        }

        // 建立 users 資料表並定義基本欄位與索引。
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('主鍵編號');
            $table->string('name', 100)->comment('使用者名稱');
            $table->string('email', 255)->unique('idx_users_email')->comment('電子郵件');
            $table->string('password', 255)->comment('雜湊密碼');
            $table->enum('role', ['user', 'admin'])->default('user')->comment('角色權限');
            $table->enum('status', ['active', 'inactive', 'banned'])->default('active')->comment('使用者狀態');
            $table->string('note', 100)->nullable()->comment('備註說明');
            $table->timestamps();

            $table->comment('系統使用者主檔');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
