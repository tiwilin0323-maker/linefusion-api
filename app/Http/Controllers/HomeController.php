<?php

namespace App\Http\Controllers;

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

    public function ping(Request $request): Response
    {
        return Response::json([
            'message' => 'pong',
            'timestamp' => now(),
            'query' => $request->query(),
        ]);
    }
}
