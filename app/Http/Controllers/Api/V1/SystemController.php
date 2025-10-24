<?php
// 此檔案負責提供系統層級的 API 端點，例如健康檢查與版本資訊查詢。

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

/**
 * 系統資訊控制器。
 *
 * @OA\Info(
 *     title="LINE Fusion API",
 *     version="0.1.0",
 *     description="提供 LINE 整合商務平台的後端服務。"
 * )
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="主要後端 API 伺服器"
 * )
 */
class SystemController extends Controller
{
    /**
     * 顯示 API 健康檢查結果。
     *
     * @OA\Get(
     *     path="/api/v1/health",
     *     tags={"System"},
     *     summary="檢查 API 健康狀態",
     *     @OA\Response(
     *         response=200,
     *         description="服務可用",
     *         @OA\JsonContent(
     *             @OA\Property(property="code", type="integer", example=0),
     *             @OA\Property(property="msg", type="string", example="success"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="status", type="string", example="ok"),
     *                 @OA\Property(property="timestamp", type="string", example="2025-01-01T00:00:00Z")
     *             )
     *         )
     *     )
     * )
     */
    public function health(): JsonResponse
    {
        return response()->json(ApiResponse::success([
            'status' => 'ok',
            'timestamp' => now()->toIso8601String(),
        ]));
    }

    /**
     * 顯示系統版本資訊。
     *
     * @OA\Get(
     *     path="/api/v1/system/version",
     *     tags={"System"},
     *     summary="取得系統版本資訊",
     *     @OA\Response(
     *         response=200,
     *         description="版本資訊",
     *         @OA\JsonContent(
     *             @OA\Property(property="code", type="integer", example=0),
     *             @OA\Property(property="msg", type="string", example="success"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="version", type="string", example="0.1.0"),
     *                 @OA\Property(property="environment", type="string", example="local")
     *             )
     *         )
     *     )
     * )
     */
    public function version(): JsonResponse
    {
        return response()->json(ApiResponse::success([
            'version' => config('app.version'),
            'environment' => config('app.env'),
        ]));
    }
}
