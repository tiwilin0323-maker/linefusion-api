<?php

use App\Http\Controllers\HomeController;

$app->router()->get('/', HomeController::class);
$app->router()->get('/api/ping', [HomeController::class, 'ping']);
