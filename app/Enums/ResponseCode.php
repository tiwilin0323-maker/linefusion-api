<?php

// 此檔案負責定義 API 通用回傳代碼列舉，統一回傳格式與訊息。

namespace App\Enums;

enum ResponseCode: int
{
    case Error = -1;
    case Success = 0;
    case Failed = 1;
    case Unauthorized = 401;
    case Forbidden = 403;
    case NotFound = 404;
    case ValidationError = 422;
    case PaymentError = 3001;
    case DatabaseError = 5000;

    public function message(): string
    {
        return match ($this) {
            self::Error => 'error',
            self::Success => 'success',
            self::Failed => 'failed',
            self::Unauthorized => 'unauthorized',
            self::Forbidden => 'forbidden',
            self::NotFound => 'not found',
            self::ValidationError => 'validation error',
            self::PaymentError => 'payment failed',
            self::DatabaseError => 'database error',
        };
    }
}
