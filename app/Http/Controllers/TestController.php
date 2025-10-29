<?php

namespace App\Http\Controllers;

use App\Core\Http\Request;
use App\Core\Http\Response;

/**
 * 測試控制器，提供簡單範例端點以驗證 API 流程。
 */
class TestController extends Controller
{
    public function index(Request $request): Response
    {
        return Response::json([
            'status' => 'ok',
            'data' => [
                'id' => 1,
                'name' => 'Test Item',
                'active' => true,
                'requested_at' => now(),
            ],
        ]);
    }
}
