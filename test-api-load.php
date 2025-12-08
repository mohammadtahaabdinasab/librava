<?php
require __DIR__ . '/vendor/autoload.php';

use Core\Api;
use Core\Auth;
use App\Controllers\Api\BookController;

// Test if classes load
try {
    echo "Api class: " . class_exists('Core\Api') . "\n";
    echo "Auth class: " . class_exists('Core\Auth') . "\n";
    echo "BookController class: " . class_exists('App\Controllers\Api\BookController') . "\n";
    
    // Test basic API response
    Api::success(['test' => 'data'], 'Test response');
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
