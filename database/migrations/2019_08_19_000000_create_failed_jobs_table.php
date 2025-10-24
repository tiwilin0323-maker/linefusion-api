<?php

// 此檔案定義建立 failed_jobs 資料表的資料庫遷移。

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 若資料表已存在則不重複建立。
        if (Schema::hasTable('failed_jobs')) {
            return;
        }

        // 建立 failed_jobs 資料表用於紀錄佇列失敗任務。
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id()->comment('主鍵編號');
            $table->string('uuid')->unique('idx_failed_jobs_uuid')->comment('任務識別碼');
            $table->text('connection')->comment('連線設定名稱');
            $table->text('queue')->comment('佇列名稱');
            $table->longText('payload')->comment('任務內容');
            $table->longText('exception')->comment('例外訊息');
            $table->timestamp('failed_at')->useCurrent()->comment('失敗時間');

            $table->comment('佇列失敗任務紀錄表');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('failed_jobs');
    }
};
