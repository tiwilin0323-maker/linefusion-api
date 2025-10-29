<?php

namespace App\Annotation;

use Attribute;

/**
 * Swagger API 註解，用來擴充操作的標題、描述與成功回應資訊。
 */
#[Attribute(Attribute::TARGET_METHOD)]
class SwaggerAPI
{
    public function __construct(
        public string $title = '',
        public string $desc = '',
        public bool $hidden = false,
        public ?SuccessResponse $success = null
    ) {
    }
}
