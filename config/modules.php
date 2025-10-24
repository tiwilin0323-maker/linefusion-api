<?php

// 此檔案列出系統模組對應的服務提供者。

return [
    'providers' => [
        App\Modules\Auth\AuthServiceProvider::class,
        App\Modules\Product\ProductServiceProvider::class,
        App\Modules\Order\OrderServiceProvider::class,
        App\Modules\Payment\PaymentServiceProvider::class,
        App\Modules\Notification\NotificationServiceProvider::class,
        App\Modules\Admin\AdminServiceProvider::class,
        App\Modules\Core\CoreServiceProvider::class,
    ],
];
