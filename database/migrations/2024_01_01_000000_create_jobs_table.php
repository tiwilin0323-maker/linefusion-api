<?php

// 此檔案定義建立 jobs 資料表的資料庫遷移。

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 若資料表已存在則不重複建立。
        if (Schema::hasTable('jobs')) {
            return;
        }

        Schema::create('jobs', function (Blueprint $table) {
            $table->id()->comment('主鍵編號');
            $table->string('queue')->index('idx_jobs_queue')->comment('佇列名稱');
            $table->longText('payload')->comment('任務內容');
            $table->unsignedTinyInteger('attempts')->comment('嘗試次數');
            $table->unsignedInteger('reserved_at')->nullable()->comment('預約時間');
            $table->unsignedInteger('available_at')->comment('可執行時間');
            $table->unsignedInteger('created_at')->comment('建立時間');

            $table->comment('佇列待執行任務資料表');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
