<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SwaggerController;
use App\Http\Controllers\TestController;

$app->router()->get('/', HomeController::class);
$app->router()->get('/api/ping', [HomeController::class, 'ping']);
$app->router()->get('/api/test', [TestController::class, 'index']);
$app->router()->get('/swagger.json', [SwaggerController::class, 'json']);
$app->router()->get('/docs', [SwaggerController::class, 'ui']);
