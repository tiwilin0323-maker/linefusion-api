<?php

namespace App\Http\Controllers;

use App\Core\Http\Request;
use App\Core\Http\Response;

/**
 * Swagger 文件控制器，負責提供 OpenAPI 規格 JSON 與線上檢視介面。
 */
class SwaggerController extends Controller
{
    public function ui(Request $request): Response
    {
        return Response::view('swagger', [
          
            'title' => 'LineFusion API 文件',
            'specUrl' => '/swagger.json',
        ]);
    }

    public function json(Request $request): Response
    {
        $spec = [
            'openapi' => '3.0.3',
            'info' => [
                'title' => 'LineFusion API',
                'version' => '1.0.0',
                'description' => 'API 說明文件',
            ],
            'servers' => [
                ['url' => $this->resolveServerUrl($request)],
            ],
            'paths' => [
                '/api/ping' => [
                    'get' => [
                        'summary' => 'API 健康檢查',
                        'responses' => [
                            '200' => [
                                'description' => '成功回應',
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            'type' => 'object',
                                            'properties' => [
                                                'message' => ['type' => 'string', 'example' => 'pong'],
                                                'timestamp' => ['type' => 'string'],
                                                'query' => ['type' => 'object'],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                '/api/test' => [
                    'get' => [
                        'summary' => '測試端點，回傳示範資料。',
                        'responses' => [
                            '200' => [
                                'description' => '成功回應',
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            'type' => 'object',
                                            'properties' => [
                                                'status' => ['type' => 'string'],
                                                'data' => [
                                                    'type' => 'object',
                                                    'properties' => [
                                                        'id' => ['type' => 'integer', 'example' => 1],
                                                        'name' => ['type' => 'string', 'example' => '測試項目'],
                                                        'active' => ['type' => 'boolean', 'example' => true],
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        return Response::json($spec);
    }

    protected function resolveServerUrl(Request $request): string
    {
        $scheme = $request->header('x-forwarded-proto') ?? ($_SERVER['HTTPS'] ?? false ? 'https' : 'http');
        $host = $request->header('host') ?? ($_SERVER['HTTP_HOST'] ?? 'localhost');

        return $scheme . '://' . $host;
    }
}
