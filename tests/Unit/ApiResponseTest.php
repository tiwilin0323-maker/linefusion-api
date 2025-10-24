<?php

// 此檔案負責測試統一回傳格式工具類別的行為是否正確。

namespace Tests\Unit;

use App\Enums\ResponseCode;
use App\Exceptions\BizException;
use App\Http\Responses\ApiResponse;
use PHPUnit\Framework\TestCase;

class ApiResponseTest extends TestCase
{
    public function test_success_response_returns_expected_structure(): void
    {
        $response = ApiResponse::success(['foo' => 'bar']);

        $this->assertSame(ResponseCode::Success->value, $response['code']);
        $this->assertSame('success', $response['msg']);
        $this->assertSame(['foo' => 'bar'], $response['data']);
    }

    public function test_failed_response_uses_exception_message_and_code(): void
    {
        $exception = BizException::create(ResponseCode::PaymentError, 'payment gateway timeout');
        $response = ApiResponse::failed($exception);

        $this->assertSame(ResponseCode::PaymentError->value, $response['code']);
        $this->assertSame('payment gateway timeout', $response['msg']);
    }

    public function test_error_response_uses_default_error_code(): void
    {
        $response = ApiResponse::error('unexpected issue');

        $this->assertSame(ResponseCode::Error->value, $response['code']);
        $this->assertSame('unexpected issue', $response['msg']);
    }
}
