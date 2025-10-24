<?php

// 此檔案定義建立 payments 資料表的資料庫遷移。

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 若資料表已存在則不重複建立。
        if (Schema::hasTable('payments')) {
            return;
        }

        // 建立 payments 資料表以記錄金流交易資訊。
        Schema::create('payments', function (Blueprint $table) {
            $table->id()->comment('主鍵編號');
            $table->unsignedBigInteger('order_id')->comment('對應訂單編號');
            $table->string('trade_no', 50)->comment('金流交易編號');
            $table->decimal('amount', 10, 2)->comment('付款金額');
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending')->comment('付款狀態');
            $table->string('response_code', 10)->nullable()->comment('金流回傳代碼');
            $table->dateTime('paid_at')->nullable()->comment('付款完成時間');
            $table->timestamps();

            $table->unique('trade_no', 'idx_payments_trade_no');
            $table->index('order_id', 'idx_payments_order_id');
            $table->index('status', 'idx_payments_status');
            $table->foreign('order_id', 'fk_payments_order_id')
                ->references('id')->on('orders')
                ->cascadeOnDelete();

            $table->comment('金流交易紀錄');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
