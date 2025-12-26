<?php
namespace Core;

class ApiResponse
{
    public static function success(string $message = 'OK', mixed $data = null, array $meta = []): string
    {
        header('Content-Type: application/json; charset=utf-8');
        return json_encode([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
            'errors' => (object)[],
            'meta' => (object)$meta,
        ], JSON_UNESCAPED_UNICODE);
    }

    public static function error(string $message = 'Error', int $code = 400, array $errors = []): string
    {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');
        return json_encode([
            'status' => 'error',
            'message' => $message,
            'data' => (object)[],
            'errors' => (object)$errors,
            'meta' => (object)[],
        ], JSON_UNESCAPED_UNICODE);
    }
}
