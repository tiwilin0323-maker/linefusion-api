<?php

// 此檔案定義建立 notifications 資料表的資料庫遷移。

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id', 'fk_notifications_user_id')->cascadeOnDelete();
            $table->enum('channel', ['LINE', 'Email']);
            $table->text('message');
            $table->enum('status', ['queued', 'sent', 'failed'])->default('queued');
            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id', 'idx_notifications_user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
