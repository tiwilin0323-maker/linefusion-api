<?php

use App\Core\Http\Request;
use App\Core\Http\Response;

$app = require __DIR__ . '/../bootstrap/app.php';

require __DIR__ . '/../routes/web.php';

$response = $app->handle(Request::capture());
$response->send();
