<?php

// 此檔案負責定義 API 通用回傳代碼列舉，統一回傳格式與訊息。

namespace App\Enums;

/**
 * 通用 API 回傳代碼列舉（英文版）
 * English-only response message for consistency.
 */
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

    /**
     * 回傳標準化的英文訊息內容。
     */
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
