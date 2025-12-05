<?php
// Quick test to debug the API

require __DIR__ . '/vendor/autoload.php';

use App\Models\Book;

try {
    $books = Book::all();
    header('Content-Type: application/json');
    echo json_encode(['status' => 'success', 'data' => $books, 'count' => count($books)]);
} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
}
