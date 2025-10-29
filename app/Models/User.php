<?php

namespace App\Models;

/**
 * 使用者資料模型，描述登入成功後回傳的基本資訊。
 */
class User
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email
    ) {
    }
}
