<?php
use Core\Env;

return [
    'host' => Env::get('DB_HOST', 'localhost'),
    'name' => Env::get('DB_NAME', 'librava'),
    'user' => Env::get('DB_USER', 'root'),
    'pass' => Env::get('DB_PASS', ''),
    'charset' => 'utf8mb4',
];
