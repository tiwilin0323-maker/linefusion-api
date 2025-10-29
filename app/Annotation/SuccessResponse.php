<?php

namespace App\Annotation;

use Attribute;

/**
 * 成功回應註解，描述 API 在成功時回傳的資料結構與說明。
 */
#[Attribute(Attribute::TARGET_METHOD)]
class SuccessResponse
{
    public function __construct(
        public string $value,
        public ?string $type = null,
        public bool $nullable = false
    ) {
    }

    public function hasType(): bool
    {
        return $this->type !== null && $this->type !== '';
    }
}
