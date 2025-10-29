<?php

namespace App\Consts;

use App\Annotation\SuccessResponse;
use App\Annotation\SwaggerAPI;
use App\Core\Http\Request;
use App\Core\Http\Response;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionType;

/**
 * Swagger 建構器，根據註解資訊產生 OpenAPI 規格內容。
 */
class SwaggerCreator
{
    public static function create(
        string $title,
        string $desc,
        array $routes,
        string $serverUrl,
        array $apiDocOptions,
        bool $removeBrokenReferenceDefinitions
    ): array {
        $paths = [];

        foreach ($routes as $route) {
            $httpMethod = strtolower($route['method'] ?? 'get');
            $path = $route['path'] ?? '/';
            $handler = $route['handler'] ?? null;

            if ($handler === null) {
                continue;
            }

            $operation = self::buildOperation($handler, $httpMethod, $route);

            if ($operation === null) {
                continue;
            }

            $paths[$path][$httpMethod] = $operation;
        }

        ksort($paths);

        return [
            'openapi' => '3.0.3',
            'info' => [
                'title' => $title,
                'description' => $desc,
                'version' => '1.0.0',
            ],
            'servers' => [
                ['url' => $serverUrl],
            ],
            'components' => [
                'securitySchemes' => [
                    SwaggerConst::TOKEN_KEY => [
                        'type' => 'apiKey',
                        'in' => 'header',
                        'name' => SystemConst::TOKEN_KEY,
                        'description' => '登入 token',
                    ],
                ],
                'responses' => [
                    SwaggerConst::RESP_NON_LOGIN => [
                        'description' => '尚未登入，操作無效',
                    ],
                    SwaggerConst::RESP_NO_PERMISSION => [
                        'description' => '沒有操作權限',
                    ],
                ],
            ],
            'paths' => $paths,
            'x-springdoc' => [
                'api-docs' => $apiDocOptions,
                'remove-broken-reference-definitions' => $removeBrokenReferenceDefinitions,
            ],
        ];
    }

    protected static function buildOperation(array|string $handler, string $httpMethod, array $route): ?array
    {
        if (is_array($handler)) {
            [$class, $method] = $handler;
        } elseif (is_string($handler)) {
            $class = $handler;
            $method = '__invoke';
        } else {
            return null;
        }

        if (!class_exists($class) || !method_exists($class, $method)) {
            return null;
        }

        $reflection = new ReflectionMethod($class, $method);
        $swagger = self::getAttributeInstance($reflection, SwaggerAPI::class);

        if ($swagger?->hidden) {
            return null;
        }

        $success = $swagger?->success ?? self::getAttributeInstance($reflection, SuccessResponse::class);
        $successDescription = self::buildSuccessDescription($success, $reflection);

        $operation = [
            'operationId' => $class . '::' . $method,
            'tags' => [self::resolveTag($reflection)],
            'summary' => $swagger?->title ?: self::humanize($method),
            'description' => $swagger?->desc ?? '',
            'responses' => [
                '200' => [
                    'description' => $successDescription,
                ],
                '401' => [
                    '$ref' => '#/components/responses/' . SwaggerConst::RESP_NON_LOGIN,
                ],
                '403' => [
                    '$ref' => '#/components/responses/' . SwaggerConst::RESP_NO_PERMISSION,
                ],
            ],
            'security' => [
                [SwaggerConst::TOKEN_KEY => []],
            ],
        ];

        $parameters = self::buildParameters($reflection);

        if (!empty($route['parameters'] ?? [])) {
            $parameters = array_merge($parameters, $route['parameters']);
        }

        if (!empty($parameters)) {
            $operation['parameters'] = $parameters;
        }

        return $operation;
    }

    protected static function buildParameters(ReflectionMethod $method): array
    {
        $parameters = [];

        foreach ($method->getParameters() as $parameter) {
            if (self::isFrameworkParameter($parameter)) {
                continue;
            }

            $parameters[] = [
                'name' => $parameter->getName(),
                'in' => 'query',
                'required' => !$parameter->isOptional() && !$parameter->allowsNull(),
                'schema' => [
                    'type' => self::mapType($parameter->getType()),
                ],
            ];
        }

        return $parameters;
    }

    protected static function buildSuccessDescription(?SuccessResponse $success, ReflectionMethod $method): string
    {
        $parts = [];

        if ($success !== null) {
            $parts[] = $success->value;
            $type = $success->hasType() ? $success->type : self::resolveReturnType($method);

            if ($type !== null) {
                $parts[] = '';
                $parts[] = '【' . self::shortClassName($type) . '】' . ($success->nullable ? '（可為 null）' : '');
            } elseif ($success->nullable) {
                $parts[] = '';
                $parts[] = '可為 null';
            }
        } else {
            $parts[] = '操作成功';
            $type = self::resolveReturnType($method);

            if ($type !== null) {
                $parts[] = '';
                $parts[] = '【' . self::shortClassName($type) . '】';
            }
        }

        return trim(implode("\n", array_filter($parts, static fn ($value) => $value !== null)));
    }

    protected static function resolveTag(ReflectionMethod $method): string
    {
        return $method->getDeclaringClass()->getShortName();
    }

    protected static function resolveReturnType(ReflectionMethod $method): ?string
    {
        $type = $method->getReturnType();

        if (!$type instanceof ReflectionNamedType) {
            return null;
        }

        $name = $type->getName();

        if ($name === Response::class || $name === Request::class) {
            return null;
        }

        return $name;
    }

    protected static function shortClassName(string $type): string
    {
        if (str_contains($type, '\\')) {
            $segments = explode('\\', $type);

            return end($segments);
        }

        return $type;
    }

    protected static function humanize(string $method): string
    {
        return ucfirst(str_replace('_', ' ', $method));
    }

    protected static function isFrameworkParameter(ReflectionParameter $parameter): bool
    {
        $type = $parameter->getType();

        if (!$type instanceof ReflectionNamedType) {
            return false;
        }

        $name = $type->getName();

        return $name === Request::class || $name === Response::class;
    }

    protected static function mapType(?ReflectionType $type): string
    {
        if ($type instanceof ReflectionNamedType) {
            if ($type->isBuiltin()) {
                return match ($type->getName()) {
                    'int', 'integer' => 'integer',
                    'bool', 'boolean' => 'boolean',
                    'float', 'double' => 'number',
                    default => 'string',
                };
            }

            return 'string';
        }

        return 'string';
    }

    protected static function getAttributeInstance(ReflectionMethod $method, string $attributeClass): mixed
    {
        $attributes = $method->getAttributes($attributeClass);

        if (empty($attributes)) {
            return null;
        }

        return $attributes[0]->newInstance();
    }
}
