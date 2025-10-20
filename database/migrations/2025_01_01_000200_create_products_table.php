<?php

// 此檔案定義建立 products 資料表的資料庫遷移。

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 若資料表已存在則不重複建立。
        if (Schema::hasTable('products')) {
            return;
        }

        Schema::create('products', function (Blueprint $table) {
            $table->id()->comment('主鍵編號');
            $table->string('name', 150)->comment('商品名稱');
            $table->string('category', 50)->comment('商品類別');
            $table->decimal('price', 10, 2)->comment('價格');
            $table->string('image_url', 255)->comment('圖片連結');
            $table->text('description')->comment('商品描述');
            $table->integer('stock')->comment('庫存數量');
            $table->enum('status', ['active', 'inactive'])->default('active')->comment('商品狀態');
            $table->timestamps();

            $table->index('category', 'idx_products_category');
            $table->index('status', 'idx_products_status');

            $table->comment('商品主檔');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
