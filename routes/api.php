<?php

use Core\Router;
use App\Controllers\Api\BookController;
use App\Controllers\Api\AuthController;
use App\Controllers\Api\UserController;

// ==================== Authentication Routes ====================
Router::add('POST', '/api/auth/register', fn() => AuthController::register());
Router::add('POST', '/api/auth/login', fn() => AuthController::login());
Router::add('GET', '/api/auth/me', fn() => AuthController::me());
Router::add('POST', '/api/auth/logout', fn() => AuthController::logout());
Router::add('POST', '/api/auth/refresh', fn() => AuthController::refresh());

// ==================== Book Routes ====================
Router::add('GET', '/api/books', fn() => BookController::list());
Router::add('GET', '/api/books/:id', fn($params) => BookController::show($params['id']));
Router::add('POST', '/api/books', fn() => BookController::store());
Router::add('PUT', '/api/books/:id', fn($params) => BookController::update($params['id']));
Router::add('DELETE', '/api/books/:id', fn($params) => BookController::delete($params['id']));

// ==================== Admin Routes ====================
Router::add('GET', '/api/admin/users', fn() => UserController::list());
Router::add('GET', '/api/admin/users/:id', fn($params) => UserController::show($params['id']));
Router::add('PUT', '/api/admin/users/:id', fn($params) => UserController::update($params['id']));
Router::add('DELETE', '/api/admin/users/:id', fn($params) => UserController::delete($params['id']));
Router::add('GET', '/api/admin/dashboard', fn() => UserController::dashboard());

