<?php

// SQLite database configuration for local development
// Database file is stored in storage/ directory
$dbPath = __DIR__ . '/../storage/librava.db';

return [
    'driver' => env('DB_DRIVER', 'sqlite'),
    'path'   => $dbPath,
    'dsn'    => 'sqlite:' . $dbPath,
];
