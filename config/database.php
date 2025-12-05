<?php

return [
    'host' => env('DB_HOST', '127.0.0.1'),
    'user' => env('DB_USER', 'root'),
    'pass' => env('DB_PASS', ''),
    'name' => env('DB_NAME', 'librava'),
    'dsn'  => sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', env('DB_HOST', '127.0.0.1'), env('DB_NAME', 'librava')),
];
