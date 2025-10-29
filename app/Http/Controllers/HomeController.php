<?php

namespace App\Http\Controllers;

use App\Annotation\SuccessResponse;
use App\Annotation\SwaggerAPI;
use App\Core\Http\Request;
use App\Core\Http\Response;

/**
 * 首頁控制器，提供顯示歡迎頁與 API ping 響應的端點。
 */
class HomeController extends Controller
{
    public function __invoke(Request $request): Response
    {
        return Response::view('welcome', [
            'appName' => 'LineFusion API',
        ]);
    }

    #[SwaggerAPI(
        title: 'API 健康檢查',
        desc: '確認服務是否正常運作。',
        success: new SuccessResponse(value: '取得目前服務狀態', type: 'array')
    )]
    public function ping(Request $request): Response
    {
        return Response::json([
            'message' => 'pong',
            'timestamp' => now(),
            'query' => $request->query(),
        ]);
    }
}
