<?php

// 此檔案包含 API 功能測試範例。

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_health_endpoint_returns_ok(): void
    {
        $response = $this->getJson('/api/v1/health');

        $response->assertStatus(200)->assertJson(['status' => 'ok']);
    }
}
