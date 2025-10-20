<?php

// 此檔案定義建立 cms_logs 資料表的資料庫遷移。

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 若資料表已存在則不重複建立。
        if (Schema::hasTable('cms_logs')) {
            return;
        }

        Schema::create('cms_logs', function (Blueprint $table) {
            $table->id()->comment('主鍵編號');
            $table->unsignedBigInteger('admin_id')->comment('操作管理者編號');
            $table->string('action', 100)->comment('操作動作');
            $table->text('detail')->nullable()->comment('操作詳情');
            $table->timestamps();
            $table->softDeletes();

            $table->index('admin_id', 'idx_cms_logs_admin_id');
            $table->foreign('admin_id', 'fk_cms_logs_admin_id')
                ->references('id')->on('users')
                ->cascadeOnDelete();

            $table->comment('後台操作紀錄資料表');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cms_logs');
    }
};
