<?php

// 此檔案定義建立 line_accounts 資料表的資料庫遷移。

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 若資料表已存在則不重複建立。
        if (Schema::hasTable('line_accounts')) {
            return;
        }

        Schema::create('line_accounts', function (Blueprint $table) {
            $table->id()->comment('主鍵編號');
            $table->unsignedBigInteger('user_id')->comment('對應使用者編號');
            $table->string('line_user_id', 255)->comment('LINE 使用者代號');
            $table->text('access_token')->comment('授權 Access Token');
            $table->text('refresh_token')->nullable()->comment('授權 Refresh Token');
            $table->timestamps();
            $table->softDeletes();

            $table->unique('line_user_id', 'idx_line_accounts_line_user_id');
            $table->index('user_id', 'idx_line_accounts_user_id');
            $table->foreign('user_id', 'fk_line_accounts_user_id')
                ->references('id')->on('users')
                ->cascadeOnDelete();

            $table->comment('LINE 綁定帳號資料表');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('line_accounts');
    }
};
