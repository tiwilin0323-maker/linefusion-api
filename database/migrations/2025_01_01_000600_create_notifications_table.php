<?php

// 此檔案定義建立 notifications 資料表的資料庫遷移。

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 若資料表已存在則不重複建立。
        if (Schema::hasTable('notifications')) {
            return;
        }

        Schema::create('notifications', function (Blueprint $table) {
            $table->id()->comment('主鍵編號');
            $table->unsignedBigInteger('user_id')->comment('接收通知的使用者編號');
            $table->enum('channel', ['LINE', 'Email'])->comment('通知管道');
            $table->text('message')->comment('通知內容');
            $table->enum('status', ['queued', 'sent', 'failed'])->default('queued')->comment('發送狀態');
            $table->timestamps();

            $table->index('user_id', 'idx_notifications_user_id');
            $table->index('status', 'idx_notifications_status');
            $table->foreign('user_id', 'fk_notifications_user_id')
                ->references('id')->on('users')
                ->cascadeOnDelete();

            $table->comment('通知發送紀錄');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
