<?php

namespace App\Http\Controllers;


use App\Config\SwaggerConfig;
use App\Core\Http\Request;
use App\Core\Http\Response;

/**
 * Swagger 文件控制器，負責提供 OpenAPI 規格 JSON 與線上檢視介面。
 */
class SwaggerController extends Controller
{
    public function ui(Request $request): Response
    {
        if (!SwaggerConfig::uiEnabled()) {
            return Response::json([
                'message' => 'Swagger UI 已停用',
            ], 404);
        }

        $meta = SwaggerConfig::metadata();
        $options = SwaggerConfig::uiOptions();

        return Response::view('swagger', [
            'title' => $meta['title'] . ' 文件',
            'specUrl' => '/swagger.json',
            'deepLinking' => $options['deep_linking'],
        ]);
    }

    public function json(Request $request): Response
    {
        if (!SwaggerConfig::apiDocsEnabled()) {
            return Response::json([
                'message' => 'Swagger 文件已停用',
            ], 404);
        }

        $spec = SwaggerConfig::createSpec($this->resolveServerUrl($request));

        return Response::json($spec);
    }

    protected function resolveServerUrl(Request $request): string
    {
        $scheme = $request->header('x-forwarded-proto') ?? ($_SERVER['HTTPS'] ?? false ? 'https' : 'http');
        $host = $request->header('host') ?? ($_SERVER['HTTP_HOST'] ?? 'localhost');

        return $scheme . '://' . $host;
    }
}
