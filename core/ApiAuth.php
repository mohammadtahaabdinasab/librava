<?php
namespace Core;

class ApiAuth
{
    public static function requireToken(): ?string
    {
        $expected = Config::get('app.api_token') ?? ($_ENV['API_TOKEN'] ?? null);

        if (!$expected) {
            return ApiResponse::error('Server misconfigured: missing API token', 500);
        }

        $auth = self::getAuthorizationHeader();
        if (!$auth) {
            return ApiResponse::error('Missing Authorization Bearer token', 401);
        }

        if (!preg_match('/^Bearer\s+(.+)$/i', trim($auth), $m)) {
            return ApiResponse::error('Invalid Authorization header', 401);
        }

        $token = trim($m[1]);

        if (!hash_equals($expected, $token)) {
            return ApiResponse::error('Invalid token', 401);
        }

        return null;
    }

    private static function getAuthorizationHeader(): ?string
    {
        $candidates = [
            $_SERVER['HTTP_AUTHORIZATION'] ?? null,
            $_SERVER['REDIRECT_HTTP_AUTHORIZATION'] ?? null,
            $_SERVER['Authorization'] ?? null,
        ];

        foreach ($candidates as $v) {
            if (is_string($v) && trim($v) !== '') return $v;
        }

        if (function_exists('getallheaders')) {
            $headers = getallheaders();
            if (is_array($headers)) {
                foreach ($headers as $k => $v) {
                    if (strcasecmp($k, 'Authorization') === 0 && is_string($v) && trim($v) !== '') {
                        return $v;
                    }
                }
            }
        }

        return null;
    }
}
