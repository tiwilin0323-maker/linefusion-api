<?php

// 此檔案定義建立 orders 資料表的資料庫遷移。

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id', 'fk_orders_user_id')->cascadeOnDelete();
            $table->string('order_no', 30)->unique();
            $table->decimal('total_amount', 10, 2);
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->enum('status', ['new', 'processing', 'completed', 'cancelled'])->default('new');
            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id', 'idx_orders_user_id');
            $table->index('payment_status', 'idx_orders_payment_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
