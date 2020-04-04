<?php

return [
    'connection' => [
        'host' => env('DB_CONNECTION'),
        'database' => env('DB_DATABASE'),
        'password' => env('DB_PASSWORD'),
        'username' => env('DB_USERNAME'),
        'port' => env('DB_PORT'),
        'charset' => env('DB_CHARSET', 'utf8mb4'),
    ]
];
