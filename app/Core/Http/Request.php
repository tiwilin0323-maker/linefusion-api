<?php

namespace App\Core\Http;

/**
 * HTTP 請求物件，負責封裝輸入方法、路徑、查詢參數、內容與標頭資訊。
 */
class Request
{
    public function __construct(
        protected string $method,
        protected string $uri,
        protected array $query,
        protected array $body,
        protected array $headers
    ) {
    }

    public static function capture(): self
    {
        $method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
        $uri = strtok($_SERVER['REQUEST_URI'] ?? '/', '?') ?: '/';
        $query = $_GET ?? [];
        $body = $_POST ?? [];
        $headers = function_exists('getallheaders') ? getallheaders() : [];

        if (empty($body)) {
            $input = file_get_contents('php://input');
            if (!empty($input)) {
                $decoded = json_decode($input, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $body = $decoded;
                }
            }
        }

        return new self($method, $uri, $query, $body, $headers);
    }

    public function method(): string
    {
        return $this->method;
    }

    public function uri(): string
    {
        return $this->uri;
    }

    public function query(?string $key = null, mixed $default = null): mixed
    {
        if ($key === null) {
            return $this->query;
        }

        return $this->query[$key] ?? $default;
    }

    public function input(?string $key = null, mixed $default = null): mixed
    {
        if ($key === null) {
            return $this->body;
        }

        return $this->body[$key] ?? $default;
    }

    public function header(string $key, mixed $default = null): mixed
    {
        $normalized = strtolower($key);
        foreach ($this->headers as $header => $value) {
            if (strtolower($header) === $normalized) {
                return $value;
            }
        }

        return $default;
    }
}
