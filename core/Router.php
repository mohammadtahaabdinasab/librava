<?php
namespace Core;

class Router
{
    private array $routes = [];
    private array $compiled = [];

    public function get(string $path, string $handler): void
    {
        $this->add('GET', $path, $handler);
    }

    public function post(string $path, string $handler): void
    {
        $this->add('POST', $path, $handler);
    }

    public function put(string $path, string $handler): void
    {
        $this->add('PUT', $path, $handler);
    }

    public function delete(string $path, string $handler): void
    {
        $this->add('DELETE', $path, $handler);
    }

    private function add(string $method, string $path, string $handler): void
    {
        $path = $this->normalize($path);
        $this->routes[$method][$path] = $handler;

        $regex = preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#', '(?P<$1>[^/]+)', $path);
        $regex = '#^' . $regex . '$#';

        $this->compiled[$method][] = [
            'path' => $path,
            'regex' => $regex,
            'handler' => $handler,
        ];
    }

    private function normalize(string $path): string
    {
        $path = '/' . trim($path, '/');
        return $path === '/' ? '/' : rtrim($path, '/');
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
        $uri = $this->normalize($uri);

        $match = $this->match($method, $uri);

        if (!$match) {
            http_response_code(404);
            echo "404 - Route not found";
            return;
        }

        [$handler, $params] = $match;

        [$controller, $action] = explode('@', $handler);

        $class = "App\\Controllers\\{$controller}";
        $file = BASE_PATH . "/app/Controllers/{$controller}.php";

        if (!is_file($file)) {
            http_response_code(500);
            echo "Controller file not found";
            return;
        }

        require_once $file;

        if (!class_exists($class)) {
            http_response_code(500);
            echo "Controller class not found";
            return;
        }

        $obj = new $class();

        if (!method_exists($obj, $action)) {
            http_response_code(500);
            echo "Action not found";
            return;
        }

        echo $obj->$action($params);
    }

    private function match(string $method, string $uri): ?array
    {
        $handler = $this->routes[$method][$uri] ?? null;
        if ($handler) {
            return [$handler, []];
        }

        foreach ($this->compiled[$method] ?? [] as $r) {
            if (preg_match($r['regex'], $uri, $m)) {
                $params = [];
                foreach ($m as $k => $v) {
                    if (!is_int($k)) $params[$k] = $v;
                }
                return [$r['handler'], $params];
            }
        }

        return null;
    }
}
