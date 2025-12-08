<?php

namespace Core;

/**
 * Authentication Service - Handle login, register, JWT tokens
 */
class Auth
{
    private static $users = [];

    // Initialize mock users data
    public static function initializeMockData()
    {
        self::$users = [
            [
                'id' => 1,
                'name' => 'Admin User',
                'email' => 'admin@librava.com',
                'password' => password_hash('admin123', PASSWORD_BCRYPT),
                'role' => 'admin',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'name' => 'John Doe',
                'email' => 'john@librava.com',
                'password' => password_hash('john123', PASSWORD_BCRYPT),
                'role' => 'user',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
    }

    /**
     * Register a new user
     */
    public static function register($name, $email, $password, $role = 'user')
    {
        self::initializeMockData();

        // Check if email already exists
        foreach (self::$users as $user) {
            if ($user['email'] === $email) {
                return ['success' => false, 'message' => 'Email already exists'];
            }
        }

        $newUser = [
            'id' => count(self::$users) + 1,
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'role' => $role,
            'status' => 'active',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        self::$users[] = $newUser;
        
        // Remove password from response
        unset($newUser['password']);
        
        return ['success' => true, 'user' => $newUser];
    }

    /**
     * Login user
     */
    public static function login($email, $password)
    {
        self::initializeMockData();

        foreach (self::$users as $user) {
            if ($user['email'] === $email && password_verify($password, $user['password'])) {
                $token = self::generateToken($user);
                $userData = $user;
                unset($userData['password']);
                
                return [
                    'success' => true,
                    'token' => $token,
                    'user' => $userData
                ];
            }
        }

        return ['success' => false, 'message' => 'Invalid email or password'];
    }

    /**
     * Generate JWT token (simple implementation)
     */
    public static function generateToken($user)
    {
        // Simple JWT-like token (base64 encoded JSON + timestamp)
        $header = base64_encode(json_encode(['typ' => 'JWT', 'alg' => 'HS256']));
        $payload = base64_encode(json_encode([
            'user_id' => $user['id'],
            'email' => $user['email'],
            'role' => $user['role'],
            'iat' => time(),
            'exp' => time() + (7 * 24 * 60 * 60) // 7 days
        ]));
        $signature = base64_encode(hash_hmac('sha256', "$header.$payload", 'your-secret-key', true));

        return "$header.$payload.$signature";
    }

    /**
     * Verify JWT token
     */
    public static function verifyToken($token)
    {
        if (!$token) {
            return ['valid' => false, 'message' => 'No token provided'];
        }

        try {
            $parts = explode('.', $token);
            if (count($parts) !== 3) {
                return ['valid' => false, 'message' => 'Invalid token format'];
            }

            [$header, $payload, $signature] = $parts;

            // Verify signature
            $expectedSignature = base64_encode(hash_hmac('sha256', "$header.$payload", 'your-secret-key', true));
            if ($signature !== $expectedSignature) {
                return ['valid' => false, 'message' => 'Invalid token signature'];
            }

            // Decode payload
            $decoded = json_decode(base64_decode($payload), true);

            // Check expiration
            if ($decoded['exp'] < time()) {
                return ['valid' => false, 'message' => 'Token expired'];
            }

            return ['valid' => true, 'data' => $decoded];
        } catch (\Exception $e) {
            return ['valid' => false, 'message' => 'Token verification failed'];
        }
    }

    /**
     * Get authenticated user from token
     */
    public static function getAuthenticatedUser()
    {
        $token = self::getBearerToken();
        if (!$token) {
            return null;
        }

        $result = self::verifyToken($token);
        return $result['valid'] ? $result['data'] : null;
    }

    /**
     * Get Bearer token from Authorization header
     */
    private static function getBearerToken()
    {
        $headers = getallheaders();
        if (isset($headers['Authorization'])) {
            $authHeader = $headers['Authorization'];
            if (preg_match('/Bearer\s+(.+)/', $authHeader, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    /**
     * Require authentication
     */
    public static function requireAuth()
    {
        $user = self::getAuthenticatedUser();
        if (!$user) {
            Api::error('Unauthorized', Api::HTTP_UNAUTHORIZED);
        }
        return $user;
    }

    /**
     * Require admin role
     */
    public static function requireAdmin()
    {
        $user = self::requireAuth();
        if ($user['role'] !== 'admin') {
            Api::error('Forbidden: Admin access required', Api::HTTP_FORBIDDEN);
        }
        return $user;
    }

    /**
     * Get all users (for admin)
     */
    public static function getAllUsers()
    {
        self::initializeMockData();
        $users = [];
        foreach (self::$users as $user) {
            unset($user['password']);
            $users[] = $user;
        }
        return $users;
    }

    /**
     * Get user by ID
     */
    public static function getUserById($id)
    {
        self::initializeMockData();
        foreach (self::$users as $user) {
            if ($user['id'] == $id) {
                unset($user['password']);
                return $user;
            }
        }
        return null;
    }
}
