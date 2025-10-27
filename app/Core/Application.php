<?php

namespace App\Core;

use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Routing\Router;
use Throwable;

/**
 * 應用程式核心，負責建立路由器並統一處理傳入的 HTTP 請求與錯誤。
 */
class Application
{
    protected Router $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    public function router(): Router
    {
        return $this->router;
    }

    public function handle(Request $request): Response
    {
        try {
            return $this->router->dispatch($request);
        } catch (Throwable $exception) {
            return Response::json([
                'message' => 'Internal Server Error',
                'error' => $exception->getMessage(),
            ], 500);
        }
    }
}
