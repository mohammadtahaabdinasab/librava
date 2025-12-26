<?php
namespace App\Controllers\Api;

use App\Models\Book;
use Core\ApiAuth;
use Core\ApiResponse;
use Core\DB;
use PDO;

class BooksController
{
    public function index(): string
    {
        if ($resp = ApiAuth::requireToken()) return $resp;

        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $perPage = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 10;
        $perPage = max(1, min(50, $perPage));
        $offset = ($page - 1) * $perPage;

        $search = trim($_GET['search'] ?? '');

        $whereSql = '';
        $params = [];

        if ($search !== '') {
            $whereSql = "WHERE title LIKE :q1 OR author LIKE :q2";
            $like = '%' . $search . '%';
            $params['q1'] = $like;
            $params['q2'] = $like;
        }

        $countStmt = DB::pdo()->prepare("SELECT COUNT(*) AS total FROM books $whereSql");
        $countStmt->execute($params);
        $total = (int)($countStmt->fetch()['total'] ?? 0);

        $dataSql = "SELECT * FROM books $whereSql ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = DB::pdo()->prepare($dataSql);

        foreach ($params as $k => $v) {
            $stmt->bindValue(':' . $k, $v, PDO::PARAM_STR);
        }
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        $books = $stmt->fetchAll();

        $lastPage = (int)max(1, ceil($total / $perPage));

        return ApiResponse::success('Books list', $books, [
            'page' => $page,
            'per_page' => $perPage,
            'total' => $total,
            'last_page' => $lastPage,
            'search' => $search,
        ]);
    }

public function show(array $params): string
{
    if ($resp = \Core\ApiAuth::requireToken()) return $resp;

    try {
        $id = (int)($params['id'] ?? 0);
        if ($id <= 0) {
            return \Core\ApiResponse::error('Invalid id', 422, ['id' => 'id must be a positive integer']);
        }

        $stmt = \Core\DB::pdo()->prepare("SELECT * FROM books WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $book = $stmt->fetch();

        if (!$book) {
            return \Core\ApiResponse::error('Book not found', 404);
        }

        return \Core\ApiResponse::success('Book details', $book);
    } catch (\Throwable $e) {
        return \Core\ApiResponse::error('Server error', 500, [
            'type' => get_class($e),
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ]);
    }
}


    public function update(array $params): string
    {
        if ($resp = ApiAuth::requireToken()) return $resp;

        $id = (int)($params['id'] ?? 0);
        if ($id <= 0) {
            return ApiResponse::error('Invalid id', 422, ['id' => 'id must be a positive integer']);
        }

        $existing = Book::find($id);
        if (!$existing) {
            return ApiResponse::error('Book not found', 404);
        }

        $raw = file_get_contents('php://input');
        $body = json_decode($raw, true);
        if (!is_array($body)) {
            return ApiResponse::error('Invalid JSON body', 400);
        }

        $title = array_key_exists('title', $body) ? trim((string)$body['title']) : (string)$existing['title'];
        $author = array_key_exists('author', $body) ? trim((string)$body['author']) : (string)$existing['author'];
        $year = array_key_exists('published_year', $body) ? $body['published_year'] : $existing['published_year'];
        $avail = array_key_exists('available', $body) ? (int)$body['available'] : (int)$existing['available'];

        $errors = [];
        if ($title === '') $errors['title'] = 'title cannot be empty';
        if ($author === '') $errors['author'] = 'author cannot be empty';

        $yearValue = null;
        if ($year !== null && $year !== '') {
            if (!is_numeric($year) || (int)$year < 0) {
                $errors['published_year'] = 'published_year must be a valid number';
            } else {
                $yearValue = (int)$year;
            }
        }

        if (!in_array($avail, [0, 1], true)) {
            $errors['available'] = 'available must be 0 or 1';
        }

        if ($errors) {
            return ApiResponse::error('Validation failed', 422, $errors);
        }

        $stmt = DB::pdo()->prepare("
            UPDATE books
               SET title = :title,
                   author = :author,
                   published_year = :year,
                   available = :avail
             WHERE id = :id
        ");

        $stmt->execute([
            'title' => $title,
            'author' => $author,
            'year' => $yearValue,
            'avail' => $avail,
            'id' => $id,
        ]);

        $updated = Book::find($id);
        return ApiResponse::success('Book updated', $updated);
    }

    public function delete(array $params): string
    {
        if ($resp = ApiAuth::requireToken()) return $resp;

        $id = (int)($params['id'] ?? 0);
        if ($id <= 0) {
            return ApiResponse::error('Invalid id', 422, ['id' => 'id must be a positive integer']);
        }

        $existing = Book::find($id);
        if (!$existing) {
            return ApiResponse::error('Book not found', 404);
        }

        $stmt = DB::pdo()->prepare("DELETE FROM books WHERE id = :id");
        $stmt->execute(['id' => $id]);

        return ApiResponse::success('Book deleted', ['id' => $id]);
    }
}
