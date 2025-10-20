<?php

// 此檔案定義建立 system_configs 資料表的資料庫遷移。

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 若資料表已存在則不重複建立。
        if (Schema::hasTable('system_configs')) {
            return;
        }

        Schema::create('system_configs', function (Blueprint $table) {
            $table->id()->comment('主鍵編號');
            $table->string('key', 100)->comment('設定鍵名');
            $table->text('value')->nullable()->comment('設定值');
            $table->string('description', 255)->nullable()->comment('設定說明');
            $table->timestamps();
            $table->softDeletes();

            $table->unique('key', 'idx_system_configs_key');
            $table->comment('系統設定參數資料表');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_configs');
    }
};
