<?php

// 此檔案定義建立 cms_logs 資料表的資料庫遷移。

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cms_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('users', 'id', 'fk_cms_logs_admin_id')->cascadeOnDelete();
            $table->string('action', 100);
            $table->text('detail')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cms_logs');
    }
};
