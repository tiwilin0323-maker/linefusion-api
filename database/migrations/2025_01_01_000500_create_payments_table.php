<?php

// 此檔案定義建立 payments 資料表的資料庫遷移。

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders', 'id', 'fk_payments_order_id')->cascadeOnDelete();
            $table->string('trade_no', 50)->unique();
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->string('response_code', 10)->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
