<?php

namespace App\Controllers\Api;

use Core\Api;
use Core\Auth;

/**
 * Authentication API Controller
 */
class AuthController
{
    /**
     * POST /api/auth/register - Register new user
     */
    public static function register()
    {
        $data = Api::getBody();

        // Validate
        $errors = Api::validate($data, ['name', 'email', 'password']);
        if ($errors) {
            Api::error('Validation failed', Api::HTTP_BAD_REQUEST, $errors);
        }

        // Password strength check
        if (strlen($data['password']) < 6) {
            Api::error('Validation failed', Api::HTTP_BAD_REQUEST, 
                ['password' => 'Password must be at least 6 characters']);
        }

        $result = Auth::register($data['name'], $data['email'], $data['password']);

        if (!$result['success']) {
            Api::error($result['message'], Api::HTTP_CONFLICT);
        }

        Api::success($result['user'], 'User registered successfully', Api::HTTP_CREATED);
    }

    /**
     * POST /api/auth/login - Login user
     */
    public static function login()
    {
        $data = Api::getBody();

        // Validate
        $errors = Api::validate($data, ['email', 'password']);
        if ($errors) {
            Api::error('Validation failed', Api::HTTP_BAD_REQUEST, $errors);
        }

        $result = Auth::login($data['email'], $data['password']);

        if (!$result['success']) {
            Api::error($result['message'], Api::HTTP_UNAUTHORIZED);
        }

        Api::success([
            'token' => $result['token'],
            'user' => $result['user']
        ], 'Login successful');
    }

    /**
     * GET /api/auth/me - Get authenticated user profile
     */
    public static function me()
    {
        $user = Auth::requireAuth();
        $userData = Auth::getUserById($user['user_id']);

        Api::success($userData, 'Profile retrieved successfully');
    }

    /**
     * POST /api/auth/logout - Logout (client-side: delete token)
     */
    public static function logout()
    {
        Auth::requireAuth();
        Api::success(null, 'Logged out successfully');
    }

    /**
     * POST /api/auth/refresh - Refresh token
     */
    public static function refresh()
    {
        $user = Auth::requireAuth();
        $userData = Auth::getUserById($user['user_id']);

        // Generate new token
        $newToken = Auth::generateToken($userData);

        Api::success([
            'token' => $newToken,
            'user' => $userData
        ], 'Token refreshed successfully');
    }
}
