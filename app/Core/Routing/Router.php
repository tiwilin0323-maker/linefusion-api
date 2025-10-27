<?php

namespace App\Core\Routing;

use App\Core\Http\Request;
use App\Core\Http\Response;

/**
 * 路由器，負責註冊與分派對應的路由動作以回應 HTTP 請求。
 */
class Router
{
    /**
     * @var array<string, array<string, callable|array|string>>
     */
    protected array $routes = [];

    public function get(string $uri, callable|array|string $action): self
    {
        return $this->addRoute('GET', $uri, $action);
    }

    public function post(string $uri, callable|array|string $action): self
    {
        return $this->addRoute('POST', $uri, $action);
    }

    public function addRoute(string $method, string $uri, callable|array|string $action): self
    {
        $this->routes[strtoupper($method)][$this->normalizeUri($uri)] = $action;

        return $this;
    }

    public function dispatch(Request $request): Response
    {
        $method = $request->method();
        $uri = $this->normalizeUri($request->uri());

        if (!isset($this->routes[$method][$uri])) {
            return Response::json([
                'message' => 'Not Found',
                'method' => $method,
                'uri' => $uri,
            ], 404);
        }

        $action = $this->routes[$method][$uri];

        if (is_string($action)) {
            $instance = new $action();

            return $instance($request);
        }

        if (is_array($action)) {
            [$class, $method] = $action;
            $instance = new $class();

            return $instance->$method($request);
        }

        return $action($request);
    }

    protected function normalizeUri(string $uri): string
    {
        $normalized = '/' . trim($uri, '/');

        return $normalized === '//' ? '/' : $normalized;
    }
}
