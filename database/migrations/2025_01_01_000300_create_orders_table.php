<?php

// 此檔案定義建立 orders 資料表的資料庫遷移。

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 若資料表已存在則不重複建立。
        if (Schema::hasTable('orders')) {
            return;
        }

        // 建立 orders 資料表以紀錄訂單主檔資訊。
        Schema::create('orders', function (Blueprint $table) {
            $table->id()->comment('主鍵編號');
            $table->unsignedBigInteger('user_id')->comment('對應使用者編號');
            $table->string('order_no', 30)->comment('訂單編號');
            $table->decimal('total_amount', 10, 2)->comment('訂單總金額');
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending')->comment('付款狀態');
            $table->enum('status', ['new', 'processing', 'completed', 'cancelled'])->default('new')->comment('訂單狀態');
            $table->timestamps();

            $table->unique('order_no', 'idx_orders_order_no');
            $table->index('user_id', 'idx_orders_user_id');
            $table->index('payment_status', 'idx_orders_payment_status');
            $table->foreign('user_id', 'fk_orders_user_id')
                ->references('id')->on('users')
                ->cascadeOnDelete();

            $table->comment('訂單主檔');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
