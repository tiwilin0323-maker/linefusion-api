<?php

// 此檔案負責定義商業邏輯例外，並封裝標準回傳代碼與訊息。

namespace App\Exceptions;

use App\Enums\ResponseCode;
use Exception;

class BizException extends Exception
{
    protected ResponseCode $responseCode;

    public function __construct(ResponseCode $responseCode, ?string $message = null)
    {
        $this->responseCode = $responseCode;
        parent::__construct($message ?? $responseCode->message(), $responseCode->value);
    }

    public static function create(ResponseCode $responseCode, ?string $message = null): self
    {
        return new self($responseCode, $message);
    }

    public function responseCode(): ResponseCode
    {
        return $this->responseCode;
    }
}
