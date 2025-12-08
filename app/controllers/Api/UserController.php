<?php

namespace App\Controllers\Api;

use Core\Api;
use Core\Auth;

/**
 * User Management API Controller (Admin only)
 */
class UserController
{
    private static $users = [];

    public static function initializeMockData()
    {
        self::$users = [
            [
                'id' => 1,
                'name' => 'Admin User',
                'email' => 'admin@librava.com',
                'role' => 'admin',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'name' => 'John Doe',
                'email' => 'john@librava.com',
                'role' => 'user',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
    }

    /**
     * GET /api/admin/users - List all users
     */
    public static function list()
    {
        Auth::requireAdmin();
        self::initializeMockData();

        $page = Api::getQuery('page', 1);
        $perPage = Api::getQuery('per_page', 10);

        $total = count(self::$users);
        $offset = ($page - 1) * $perPage;
        $users = array_slice(self::$users, $offset, $perPage);

        Api::paginated($users, $total, $page, $perPage, 'Users retrieved successfully');
    }

    /**
     * GET /api/admin/users/:id - Get single user
     */
    public static function show($id)
    {
        Auth::requireAdmin();
        self::initializeMockData();

        $user = null;
        foreach (self::$users as $u) {
            if ($u['id'] == $id) {
                $user = $u;
                break;
            }
        }

        if (!$user) {
            Api::error('User not found', Api::HTTP_NOT_FOUND);
        }

        Api::success($user, 'User retrieved successfully');
    }

    /**
     * PUT /api/admin/users/:id - Update user
     */
    public static function update($id)
    {
        Auth::requireAdmin();
        self::initializeMockData();

        $user = null;
        $key = null;
        foreach (self::$users as $k => $u) {
            if ($u['id'] == $id) {
                $user = $u;
                $key = $k;
                break;
            }
        }

        if (!$user) {
            Api::error('User not found', Api::HTTP_NOT_FOUND);
        }

        $data = Api::getBody();

        $updated = array_merge($user, array_filter([
            'name' => $data['name'] ?? null,
            'role' => $data['role'] ?? null,
            'status' => $data['status'] ?? null,
            'updated_at' => date('Y-m-d H:i:s')
        ], fn($v) => $v !== null));

        self::$users[$key] = $updated;

        Api::success($updated, 'User updated successfully');
    }

    /**
     * DELETE /api/admin/users/:id - Delete user
     */
    public static function delete($id)
    {
        Auth::requireAdmin();
        self::initializeMockData();

        $user = null;
        $key = null;
        foreach (self::$users as $k => $u) {
            if ($u['id'] == $id) {
                $user = $u;
                $key = $k;
                break;
            }
        }

        if (!$user) {
            Api::error('User not found', Api::HTTP_NOT_FOUND);
        }

        // Don't allow deleting self
        $authUser = Auth::getAuthenticatedUser();
        if ($authUser['user_id'] == $id) {
            Api::error('Cannot delete your own account', Api::HTTP_BAD_REQUEST);
        }

        unset(self::$users[$key]);

        Api::success(['id' => $id], 'User deleted successfully');
    }

    /**
     * GET /api/admin/dashboard - Dashboard stats
     */
    public static function dashboard()
    {
        Auth::requireAdmin();
        self::initializeMockData();

        // Mock statistics
        $stats = [
            'total_users' => count(self::$users),
            'active_users' => count(array_filter(self::$users, fn($u) => $u['status'] === 'active')),
            'admin_count' => count(array_filter(self::$users, fn($u) => $u['role'] === 'admin')),
            'total_books' => 3,
            'today_signups' => 1,
            'last_updated' => date('Y-m-d H:i:s')
        ];

        Api::success($stats, 'Dashboard data retrieved successfully');
    }
}
