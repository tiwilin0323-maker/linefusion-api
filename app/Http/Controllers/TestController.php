<?php

namespace App\Http\Controllers;

use App\Annotation\SuccessResponse;
use App\Annotation\SwaggerAPI;
use App\Core\Http\Request;
use App\Core\Http\Response;

/**
 * 測試控制器，提供簡單範例端點以驗證 API 流程。
 */
class TestController extends Controller
{
    #[SwaggerAPI(
        title: '測試端點',
        desc: '回傳範例資料以驗證 API 流程。',
        success: new SuccessResponse(value: '成功取得測試資料', type: 'array')
    )]
    public function index(Request $request): Response
    {
        return Response::json([
            'status' => 'ok',
            'data' => [
                'id' => 1,
                'name' => '測試項目',
                'active' => true,
                'requested_at' => now(),
            ],
        ]);
    }
}
