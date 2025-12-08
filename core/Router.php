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
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = rtrim($uri, '/') ?: '/';
        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            $match = self::matchRoute($route['path'], $uri);
            
            if ($route['method'] === $method && $match['matched']) {
                $handler = $route['handler'];
                if (is_callable($handler)) {
                    // Pass parameters if route has dynamic segments
                    if (!empty($match['params'])) {
                        return call_user_func($handler, $match['params']);
                    }
                    return call_user_func($handler);
                }
            }
        }

        // Route not found - return 404 API response
        // Check if it's an API route (starts with /api)
        if (strpos($uri, '/api') === 0) {
            Api::error('Route not found', Api::HTTP_NOT_FOUND);
        } else {
            // Web routes
            http_response_code(404);
            echo 'Not Found';
        }
    }

    /**
     * Match route pattern with URI
     * Converts /api/books/:id to regex pattern
     */
    private static function matchRoute($pattern, $uri)
    {
        $params = [];
        
        // Convert route pattern to regex
        $regex = preg_replace_callback('/:([a-zA-Z_]+)/', function ($matches) use (&$params) {
            $params[$matches[1]] = null;
            return '([a-zA-Z0-9_-]+)';
        }, $pattern);

        $regex = '#^' . $regex . '$#';

        if (preg_match($regex, $uri, $matches)) {
            // Extract matched parameters
            array_shift($matches); // Remove full match
            $paramNames = array_keys($params);
            
            foreach ($matches as $index => $value) {
                if (isset($paramNames[$index])) {
                    $params[$paramNames[$index]] = $value;
                }
            }

            return ['matched' => true, 'params' => $params];
        }

        return ['matched' => false, 'params' => []];
    }
}

