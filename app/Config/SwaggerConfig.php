<?php

namespace App\Config;

use App\Consts\SwaggerCreator;

/**
 * Swagger 設定，負責統整 UI 與文件的配置值。
 */
class SwaggerConfig
{
    public static function uiEnabled(): bool
    {
        return self::uiOptions()['enabled'];
    }

    public static function uiOptions(): array
    {
        return [
            'enabled' => true,
            'deep_linking' => true,
        ];
    }

    public static function apiDocsEnabled(): bool
    {
        return self::apiDocsOptions()['enabled'];
    }

    public static function apiDocsOptions(): array
    {
        return [
            'enabled' => true,
            'resolve_schema_properties' => true,
        ];
    }

    public static function removeBrokenReferenceDefinitions(): bool
    {
        return false;
    }

    public static function metadata(): array
    {
        return [
            'title' => 'Service API',
            'desc' => 'API',
        ];
    }

    public static function documentedRoutes(): array
    {
        return [
            [
                'method' => 'get',
                'path' => '/api/ping',
                'handler' => [\App\Http\Controllers\HomeController::class, 'ping'],
            ],
            [
                'method' => 'get',
                'path' => '/api/test',
                'handler' => [\App\Http\Controllers\TestController::class, 'index'],
            ],
            [
                'method' => 'get',
                'path' => '/api/login',
                'handler' => [\App\Http\Controllers\AuthController::class, 'login'],
                'parameters' => [
                    [
                        'name' => 'account',
                        'in' => 'query',
                        'description' => '登入帳號',
                        'required' => true,
                        'schema' => ['type' => 'string'],
                    ],
                    [
                        'name' => 'password',
                        'in' => 'query',
                        'description' => '登入密碼',
                        'required' => true,
                        'schema' => ['type' => 'string', 'format' => 'password'],
                    ],
                ],
            ],
        ];
    }

    public static function createSpec(string $serverUrl): array
    {
        $meta = self::metadata();

        return SwaggerCreator::create(
            $meta['title'],
            $meta['desc'],
            self::documentedRoutes(),
            $serverUrl,
            self::apiDocsOptions(),
            self::removeBrokenReferenceDefinitions()
        );
    }
}
