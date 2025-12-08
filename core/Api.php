<?php

namespace Core;

/**
 * API Response Handler - Standardizes all API responses
 */
class Api
{
    // HTTP Status Codes
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;
    const HTTP_CONFLICT = 409;
    const HTTP_INTERNAL_ERROR = 500;

    /**
     * Send a successful response
     */
    public static function success($data = null, $message = 'Success', $statusCode = self::HTTP_OK, $meta = [])
    {
        self::respond([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
            'meta' => $meta
        ], $statusCode);
    }

    /**
     * Send an error response
     */
    public static function error($message = 'Error', $statusCode = self::HTTP_BAD_REQUEST, $errors = [])
    {
        self::respond([
            'status' => 'error',
            'message' => $message,
            'data' => null,
            'errors' => $errors
        ], $statusCode);
    }

    /**
     * Send a paginated response
     */
    public static function paginated($data, $total, $page, $perPage, $message = 'Success')
    {
        $totalPages = ceil($total / $perPage);
        self::respond([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
            'meta' => [
                'page' => (int)$page,
                'per_page' => (int)$perPage,
                'total' => (int)$total,
                'total_pages' => (int)$totalPages
            ]
        ], self::HTTP_OK);
    }

    /**
     * Send JSON response
     */
    private static function respond($payload, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        exit;
    }

    /**
     * Get JSON request body
     */
    public static function getBody()
    {
        $input = file_get_contents('php://input');
        return json_decode($input, true) ?? [];
    }

    /**
     * Validate required fields
     */
    public static function validate($data, $required = [])
    {
        $errors = [];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                $errors[$field] = "The $field field is required.";
            }
        }
        return $errors;
    }

    /**
     * Get request method
     */
    public static function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Get query parameter
     */
    public static function getQuery($key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }
}
