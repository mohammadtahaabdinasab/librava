<?php

namespace App\Controllers\Api;

use Core\Api;
use Core\Auth;
use App\Models\Book;

/**
 * Book API Controller - Handle all book-related endpoints
 */
class BookController
{
    /**
     * GET /api/books - List all books with pagination
     */
    public static function list()
    {
        $page = Api::getQuery('page', 1);
        $perPage = Api::getQuery('per_page', 10);
        $search = Api::getQuery('search', '');

        // Get all books
        $allBooks = Book::all();

        // Filter by search
        if ($search) {
            $allBooks = array_filter($allBooks, function ($book) use ($search) {
                return stripos($book['title'], $search) !== false || 
                       stripos($book['author'], $search) !== false;
            });
        }

        // Paginate
        $total = count($allBooks);
        $offset = ($page - 1) * $perPage;
        $books = array_slice($allBooks, $offset, $perPage);

        Api::paginated($books, $total, $page, $perPage, 'Books retrieved successfully');
    }

    /**
     * GET /api/books/:id - Get single book
     */
    public static function show($id)
    {
        $book = Book::findById($id);

        if (!$book) {
            Api::error('Book not found', Api::HTTP_NOT_FOUND);
        }

        Api::success($book, 'Book retrieved successfully');
    }

    /**
     * POST /api/books - Create new book (admin only)
     */
    public static function store()
    {
        Auth::requireAdmin();

        $data = Api::getBody();

        // Validate required fields
        $errors = Api::validate($data, ['title', 'author', 'published_year']);
        if ($errors) {
            Api::error('Validation failed', Api::HTTP_BAD_REQUEST, $errors);
        }

        $newBook = [
            'id' => (int)(max(array_column(Book::all(), 'id')) ?? 0) + 1,
            'title' => $data['title'],
            'author' => $data['author'],
            'published_year' => (int)$data['published_year'],
            'created_at' => date('Y-m-d H:i:s')
        ];

        // In a real scenario, save to database
        // For now, return the created book
        Api::success($newBook, 'Book created successfully', Api::HTTP_CREATED);
    }

    /**
     * PUT /api/books/:id - Update book (admin only)
     */
    public static function update($id)
    {
        Auth::requireAdmin();

        $book = Book::findById($id);
        if (!$book) {
            Api::error('Book not found', Api::HTTP_NOT_FOUND);
        }

        $data = Api::getBody();

        // Update fields
        $updated = array_merge($book, array_filter([
            'title' => $data['title'] ?? null,
            'author' => $data['author'] ?? null,
            'published_year' => isset($data['published_year']) ? (int)$data['published_year'] : null,
            'updated_at' => date('Y-m-d H:i:s')
        ], fn($v) => $v !== null));

        Api::success($updated, 'Book updated successfully');
    }

    /**
     * DELETE /api/books/:id - Delete book (admin only)
     */
    public static function delete($id)
    {
        Auth::requireAdmin();

        $book = Book::findById($id);
        if (!$book) {
            Api::error('Book not found', Api::HTTP_NOT_FOUND);
        }

        // In a real scenario, delete from database
        // For now, return success
        Api::success(['id' => $id], 'Book deleted successfully');
    }
}
