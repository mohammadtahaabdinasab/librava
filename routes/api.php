<?php

use Core\Router;
use App\Models\Book;

// API routes
Router::add('GET', '/api/books', function () {
    header('Content-Type: application/json');
    try {
        $books = Book::all();
        echo json_encode(['status' => 'success', 'data' => $books]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
});

// Add more API routes here

