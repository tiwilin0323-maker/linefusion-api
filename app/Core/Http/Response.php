<?php

namespace App\Core\Http;

/**
 * HTTP 回應物件，負責封裝輸出的內容、狀態碼與標頭並提供便利的建立方法。
 */
class Response
{
    public function __construct(
        protected string $content,
        protected int $status = 200,
        protected array $headers = []
    ) {
    }

    public static function json(array $payload, int $status = 200, array $headers = []): self
    {
        $headers = array_merge(['Content-Type' => 'application/json'], $headers);

        return new self(json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT), $status, $headers);
    }

    public static function view(string $view, array $data = [], int $status = 200, array $headers = []): self
    {
        $path = __DIR__ . '/../../../resources/views/' . $view . '.php';

        if (!file_exists($path)) {
            return self::json([
                'message' => 'View not found',
                'view' => $view,
            ], 500);
        }

        extract($data);

        ob_start();
        include $path;
        $content = ob_get_clean();

        $headers = array_merge(['Content-Type' => 'text/html; charset=utf-8'], $headers);

        return new self($content, $status, $headers);
    }

    public function send(): void
    {
        http_response_code($this->status);
        foreach ($this->headers as $header => $value) {
            header($header . ': ' . $value);
        }

        echo $this->content;
    }
}
