<?php

namespace Core;

require_once __DIR__ . '/helpers.php';

class App
{
    public static function run()
    {
        // Load route definitions
        $web = __DIR__ . '/../routes/web.php';
        $api = __DIR__ . '/../routes/api.php';
        if (file_exists($web)) {
            require $web;
        }
        if (file_exists($api)) {
            require $api;
        }

        // Dispatch request
        Router::dispatch();
    }
}
