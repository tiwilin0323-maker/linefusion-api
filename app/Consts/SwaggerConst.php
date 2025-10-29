<?php

namespace App\Consts;

/**
 * Swagger 常數定義，提供文件生成時共用的鍵值。
 */
class SwaggerConst
{
    public const TOKEN_KEY = 'authToken';
    public const RESP_NON_LOGIN = 'nonLogin';
    public const RESP_NO_PERMISSION = 'noPermission';

    private function __construct()
    {
    }
}
