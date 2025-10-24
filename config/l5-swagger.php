<?php
// 此檔案配置 L5 Swagger 產生器與文件路由相關設定，方便快速生成 API 文件。

return [
    'default' => 'default',
    'documentations' => [
        'default' => [
            'api' => [
                'title' => env('APP_NAME', 'LINE Fusion API') . ' 文件',
            ],
            'routes' => [
                'api' => 'l5-swagger.default.api',
                'docs' => 'l5-swagger.default.docs',
                'oauth2_callback' => 'l5-swagger.default.oauth2_callback',
            ],
            'paths' => [
                'docs' => storage_path('api-docs'),
                'docs_json' => 'api-docs.json',
                'docs_yaml' => 'api-docs.yaml',
                'format_to_use_for_docs' => env('L5_SWAGGER_FORMAT', 'json'),
                'annotations' => [
                    base_path('app/Http/Controllers'),
                    base_path('routes'),
                ],
                'base' => env('L5_SWAGGER_BASE_PATH', null),
                'excludes' => [],
            ],
            'securityDefinitions' => [
                'bearerAuth' => [
                    'type' => 'http',
                    'description' => '請於 Header 中帶入 Bearer Token。',
                    'scheme' => 'bearer',
                    'bearerFormat' => 'JWT',
                ],
            ],
        ],
    ],
    'paths' => [
        'use_absolute_path' => false,
        'docs_json' => storage_path('api-docs/api-docs.json'),
        'docs_yaml' => storage_path('api-docs/api-docs.yaml'),
        'format_to_use_for_docs' => env('L5_SWAGGER_FORMAT', 'json'),
        'annotations' => [
            base_path('app/Http/Controllers'),
        ],
        'excludes' => [],
        'base' => env('L5_SWAGGER_BASE_PATH', null),
    ],
    'generate_always' => env('L5_SWAGGER_GENERATE_ALWAYS', false),
    'generate_yaml_copy' => false,
    'proxy' => false,
    'additional_config_url' => null,
    'operations_sort' => env('L5_SWAGGER_OPERATIONS_SORT', null),
    'validator_url' => null,
    'constants' => [
        'L5_SWAGGER_CONST_HOST' => env('APP_URL', 'http://localhost'),
    ],
];
