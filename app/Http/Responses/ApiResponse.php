<?php

// 此檔案負責提供統一的 API 回傳格式，方便控制器直接呼叫。

namespace App\Http\Responses;

use App\Enums\ResponseCode;
use App\Exceptions\BizException;

class ApiResponse
{
    public static function success(mixed $data = null): array
    {
        return [
            'code' => ResponseCode::Success->value,
            'msg' => ResponseCode::Success->message(),
            'data' => $data,
        ];
    }

    public static function failed(BizException $exception): array
    {
        return [
            'code' => $exception->getCode(),
            'msg' => $exception->getMessage(),
        ];
    }

    public static function error(string $message): array
    {
        return [
            'code' => ResponseCode::Error->value,
            'msg' => $message,
        ];
    }
}
