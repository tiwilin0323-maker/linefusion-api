<?php

// 此檔案定義建立 order_items 資料表的資料庫遷移。

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders', 'id', 'fk_order_items_order_id')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products', 'id', 'fk_order_items_product_id');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['order_id', 'product_id'], 'idx_order_items_order_product');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
