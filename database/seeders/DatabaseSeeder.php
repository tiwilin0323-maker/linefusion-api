<?php

// 此檔案負責統籌執行資料庫預設資料的填充流程。

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            InitialDataSeeder::class,
        ]);
    }
}
