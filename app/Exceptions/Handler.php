<?php

// 此檔案負責處理應用程式的例外狀況與錯誤回報邏輯。

namespace App\Exceptions;

use App\Http\Responses\ApiResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // 可在此加入額外的例外通報或記錄機制。
        });
    }

    public function render($request, Throwable $e): JsonResponse|Response
    {
        if ($e instanceof BizException) {
            return response()->json(ApiResponse::failed($e));
        }

        if ($request instanceof Request && $request->expectsJson()) {
            return response()->json(ApiResponse::error($e->getMessage()), 500);
        }

        return parent::render($request, $e);
    }
}
