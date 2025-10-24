<?php

// 此檔案定義建立 personal_access_tokens 資料表的資料庫遷移。

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 若資料表已存在則不重複建立。
        if (Schema::hasTable('personal_access_tokens')) {
            return;
        }

        // 建立 personal_access_tokens 資料表儲存個人 API Token。
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id()->comment('主鍵編號');
            $table->string('tokenable_type')->comment('授權模型類型');
            $table->unsignedBigInteger('tokenable_id')->comment('授權模型主鍵');
            $table->string('name')->comment('Token 名稱');
            $table->string('token', 64)->unique('idx_personal_access_tokens_token')->comment('Token 值');
            $table->text('abilities')->nullable()->comment('可用權限範圍');
            $table->timestamp('last_used_at')->nullable()->comment('最後使用時間');
            $table->timestamp('expires_at')->nullable()->comment('到期時間');
            $table->timestamps();

            $table->index(['tokenable_type', 'tokenable_id'], 'idx_personal_access_tokens_tokenable');

            $table->comment('個人存取 Token 資料表');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
