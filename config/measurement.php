<?php

declare(strict_types=1);

return [
    'measurements' => [
        [
            'type' => 'mysql.speed',
            'connection' => 'mysql',
            'key' => 'mysql.default.speed',
        ],
        [
            'type' => 'redis.speed',
            'connection' => 'default',
            'key' => 'redis.default.speed',
        ],
        [
            'type' => 'queue.waiting-time',
            'queue' => 'default',
            'key' => 'queue.default.waiting-time',
        ],
        [
            'type' => 'queue.size',
            'queue' => 'default',
            'key' => 'queue.default.size',
        ],
    ],
];
