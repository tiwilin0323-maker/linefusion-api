<?php

// 此檔案定義建立 order_items 資料表的資料庫遷移。

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 若資料表已存在則不重複建立。
        if (Schema::hasTable('order_items')) {
            return;
        }

        // 建立 order_items 資料表以儲存訂單細項。
        Schema::create('order_items', function (Blueprint $table) {
            $table->id()->comment('主鍵編號');
            $table->unsignedBigInteger('order_id')->comment('對應訂單編號');
            $table->unsignedBigInteger('product_id')->comment('對應商品編號');
            $table->integer('quantity')->comment('訂購數量');
            $table->decimal('price', 10, 2)->comment('商品單價');
            $table->timestamps();

            $table->index('order_id', 'idx_order_items_order_id');
            $table->index('product_id', 'idx_order_items_product_id');
            $table->foreign('order_id', 'fk_order_items_order_id')
                ->references('id')->on('orders')
                ->cascadeOnDelete();
            $table->foreign('product_id', 'fk_order_items_product_id')
                ->references('id')->on('products')
                ->cascadeOnDelete();

            $table->comment('訂單明細資料表');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
