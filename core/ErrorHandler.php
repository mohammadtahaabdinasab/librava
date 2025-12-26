<?php
namespace Core;

class ErrorHandler
{
    public static function register(): void
    {
        set_error_handler([self::class, 'handleError']);
        set_exception_handler([self::class, 'handleException']);
        register_shutdown_function([self::class, 'handleShutdown']);
    }

    public static function handleError(int $severity, string $message, string $file, int $line): bool
    {
        throw new \ErrorException($message, 0, $severity, $file, $line);
    }

    public static function handleException(\Throwable $e): void
    {
        $isApi = self::isApiRequest();

        if ($isApi) {
            http_response_code(500);
            header('Content-Type: application/json; charset=utf-8');

            $debug = (bool)Config::get('app.debug');

            $payload = [
                'status' => 'error',
                'message' => 'Server error',
                'data' => (object)[],
                'errors' => $debug ? [
                    'type' => get_class($e),
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ] : (object)[],
                'meta' => (object)[],
            ];

            echo json_encode($payload, JSON_UNESCAPED_UNICODE);
            return;
        }

        http_response_code(500);
        echo "Server error";
    }

    public static function handleShutdown(): void
    {
        $err = error_get_last();
        if (!$err) return;

        $fatalTypes = [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR];
        if (!in_array($err['type'], $fatalTypes, true)) return;

        if (self::isApiRequest()) {
            http_response_code(500);
            header('Content-Type: application/json; charset=utf-8');

            $debug = (bool)Config::get('app.debug');

            $payload = [
                'status' => 'error',
                'message' => 'Server error',
                'data' => (object)[],
                'errors' => $debug ? [
                    'type' => $err['type'],
                    'message' => $err['message'],
                    'file' => $err['file'],
                    'line' => $err['line'],
                ] : (object)[],
                'meta' => (object)[],
            ];

            echo json_encode($payload, JSON_UNESCAPED_UNICODE);
        }
    }

    private static function isApiRequest(): bool
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '';
        return str_starts_with($uri, '/api/');
    }
}
