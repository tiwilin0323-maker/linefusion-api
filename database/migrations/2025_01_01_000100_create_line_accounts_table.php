<?php

// 此檔案定義建立 line_accounts 資料表的資料庫遷移。

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('line_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id', 'fk_line_accounts_user_id')->cascadeOnDelete();
            $table->string('line_user_id', 255)->unique();
            $table->text('access_token');
            $table->text('refresh_token')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('line_accounts');
    }
};
