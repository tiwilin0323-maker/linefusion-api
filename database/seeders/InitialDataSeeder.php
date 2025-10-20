<?php

// 此檔案負責建立系統啟動所需的範例資料。

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InitialDataSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $now = Carbon::now();

            $adminId = DB::table('users')->insertGetId([
                'name' => '系統管理員',
                'email' => 'admin@example.com',
                'password' => Hash::make('Password!234'),
                'role' => 'admin',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $userId = DB::table('users')->insertGetId([
                'name' => '一般會員',
                'email' => 'user@example.com',
                'password' => Hash::make('Password!234'),
                'role' => 'user',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('line_accounts')->insert([
                'user_id' => $userId,
                'line_user_id' => 'U' . Str::upper(Str::random(32)),
                'access_token' => Str::random(40),
                'refresh_token' => Str::random(60),
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $productId = DB::table('products')->insertGetId([
                'name' => '似顏繪客製服務',
                'category' => 'illustration',
                'price' => 890,
                'image_url' => 'https://example.com/products/custom-portrait.png',
                'description' => '專屬客製似顏繪插畫，付款後三日內交件。',
                'stock' => 100,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $orderNo = 'A' . $now->format('Ymd') . '001';

            $orderId = DB::table('orders')->insertGetId([
                'user_id' => $userId,
                'order_no' => $orderNo,
                'total_amount' => 890,
                'payment_status' => 'paid',
                'status' => 'completed',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('order_items')->insert([
                'order_id' => $orderId,
                'product_id' => $productId,
                'quantity' => 1,
                'price' => 890,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('payments')->insert([
                'order_id' => $orderId,
                'trade_no' => 'NEWEBPAY' . $now->format('YmdHis'),
                'amount' => 890,
                'status' => 'success',
                'response_code' => '0000',
                'paid_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('notifications')->insert([
                'user_id' => $userId,
                'channel' => 'LINE',
                'message' => '您的訂單已付款成功，感謝支持！',
                'status' => 'sent',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('cms_logs')->insert([
                'admin_id' => $adminId,
                'action' => '建立商品',
                'detail' => '系統管理員建立了預設商品資料。',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('system_configs')->insert([
                'key' => 'site_name',
                'value' => 'LINE 整合商務系統',
                'description' => '網站標題顯示名稱',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        });
    }
}
