<?php

namespace Core;

class Router
{
    protected static $routes = [];

    public static function add(string $method, string $path, $handler)
    {
        self::$routes[] = compact('method', 'path', 'handler');
    }

    public static function dispatch()
    {
        // Very simple dispatcher placeholder
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // Remove trailing slash for consistency
        $uri = rtrim($uri, '/') ?: '/';
        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            if ($route['method'] === $method && $route['path'] === $uri) {
                $handler = $route['handler'];
                if (is_callable($handler)) {
                    return call_user_func($handler);
                }
            }
        }

        // Route not found
        http_response_code(404);
        echo 'Not Found';
    }
}
