<?php
namespace App\Controllers\Api;

use Core\ApiAuth;
use Core\ApiResponse;
use Core\DB;
use PDO;

class BorrowsController
{
    private function readJson(): ?array
    {
        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true);
        return is_array($data) ? $data : null;
    }

    public function index(): string
    {
        if ($resp = ApiAuth::requireToken()) return $resp;

        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $perPage = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 10;
        $perPage = max(1, min(50, $perPage));
        $offset = ($page - 1) * $perPage;

        $search = trim($_GET['search'] ?? '');

        $where = '';
        $params = [];

        if ($search !== '') {
            $where = "WHERE b.title LIKE :q1 OR u.full_name LIKE :q2 OR u.email LIKE :q3";
            $like = '%' . $search . '%';
            $params['q1'] = $like;
            $params['q2'] = $like;
            $params['q3'] = $like;
        }

        $countSql = "
            SELECT COUNT(*) AS total
            FROM borrows br
            JOIN books b ON b.id = br.book_id
            JOIN users u ON u.id = br.user_id
            $where
        ";

        $pdo = DB::pdo();
        $countStmt = $pdo->prepare($countSql);
        $countStmt->execute($params);
        $total = (int)($countStmt->fetch()['total'] ?? 0);

        $dataSql = "
            SELECT
              br.id,
              br.user_id,
              br.book_id,
              br.borrowed_at,
              br.due_at,
              br.returned_at,
              u.full_name,
              u.email,
              b.title AS book_title,
              b.author AS book_author
            FROM borrows br
            JOIN books b ON b.id = br.book_id
            JOIN users u ON u.id = br.user_id
            $where
            ORDER BY br.id DESC
            LIMIT :limit OFFSET :offset
        ";

        $stmt = $pdo->prepare($dataSql);

        foreach ($params as $k => $v) {
            $stmt->bindValue(':' . $k, $v, PDO::PARAM_STR);
        }
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        $rows = $stmt->fetchAll();

        $lastPage = (int)max(1, ceil($total / $perPage));

        return ApiResponse::success('Borrows list', $rows, [
            'page' => $page,
            'per_page' => $perPage,
            'total' => $total,
            'last_page' => $lastPage,
            'search' => $search,
        ]);
    }

    public function show(string $id): string
    {
        if ($resp = ApiAuth::requireToken()) return $resp;

        $borrowId = (int)$id;
        if ($borrowId <= 0) {
            return ApiResponse::error('Invalid id', 422, ['id' => 'id must be a positive integer']);
        }

        $sql = "
            SELECT
              br.id,
              br.user_id,
              br.book_id,
              br.borrowed_at,
              br.due_at,
              br.returned_at,
              u.full_name,
              u.email,
              b.title AS book_title,
              b.author AS book_author
            FROM borrows br
            JOIN users u ON u.id = br.user_id
            JOIN books b ON b.id = br.book_id
            WHERE br.id = :id
            LIMIT 1
        ";

        $stmt = DB::pdo()->prepare($sql);
        $stmt->execute(['id' => $borrowId]);
        $row = $stmt->fetch();

        if (!$row) {
            return ApiResponse::error('Borrow not found', 404);
        }

        return ApiResponse::success('Borrow details', $row);
    }

    public function store(): string
    {
        if ($resp = ApiAuth::requireToken()) return $resp;

        $body = $this->readJson();
        if (!$body) {
            return ApiResponse::error('Invalid JSON body', 400);
        }

        $userId = (int)($body['user_id'] ?? 0);
        $bookId = (int)($body['book_id'] ?? 0);
        $dueDays = isset($body['due_days']) ? (int)$body['due_days'] : 14;

        $errors = [];
        if ($userId <= 0) $errors['user_id'] = 'user_id must be a positive integer';
        if ($bookId <= 0) $errors['book_id'] = 'book_id must be a positive integer';
        if ($dueDays < 1 || $dueDays > 60) $errors['due_days'] = 'due_days must be between 1 and 60';
        if ($errors) return ApiResponse::error('Validation failed', 422, $errors);

        $pdo = DB::pdo();
        $pdo->beginTransaction();

        try {
            $u = $pdo->prepare("SELECT id FROM users WHERE id = :id LIMIT 1");
            $u->execute(['id' => $userId]);
            if (!$u->fetch()) {
                $pdo->rollBack();
                return ApiResponse::error('User not found', 404);
            }

            $b = $pdo->prepare("SELECT id, available FROM books WHERE id = :id FOR UPDATE");
            $b->execute(['id' => $bookId]);
            $book = $b->fetch();

            if (!$book) {
                $pdo->rollBack();
                return ApiResponse::error('Book not found', 404);
            }

            if ((int)$book['available'] !== 1) {
                $pdo->rollBack();
                return ApiResponse::error('Book is not available', 409);
            }

            $active = $pdo->prepare("SELECT id FROM borrows WHERE book_id = :book_id AND returned_at IS NULL LIMIT 1");
            $active->execute(['book_id' => $bookId]);
            if ($active->fetch()) {
                $pdo->rollBack();
                return ApiResponse::error('Book already borrowed', 409);
            }

            $ins = $pdo->prepare("
                INSERT INTO borrows (user_id, book_id, borrowed_at, due_at, returned_at)
                VALUES (:user_id, :book_id, NOW(), DATE_ADD(NOW(), INTERVAL :due_days DAY), NULL)
            ");
            $ins->bindValue(':user_id', $userId, PDO::PARAM_INT);
            $ins->bindValue(':book_id', $bookId, PDO::PARAM_INT);
            $ins->bindValue(':due_days', $dueDays, PDO::PARAM_INT);
            $ins->execute();

            $borrowId = (int)$pdo->lastInsertId();

            $upd = $pdo->prepare("UPDATE books SET available = 0 WHERE id = :id");
            $upd->execute(['id' => $bookId]);

            $pdo->commit();

            $fetch = $pdo->prepare("SELECT * FROM borrows WHERE id = :id LIMIT 1");
            $fetch->execute(['id' => $borrowId]);
            $created = $fetch->fetch();

            return ApiResponse::success('Borrow created', $created ?: [
                'id' => $borrowId,
                'user_id' => $userId,
                'book_id' => $bookId,
                'due_days' => $dueDays,
            ]);
        } catch (\Throwable $e) {
            if ($pdo->inTransaction()) $pdo->rollBack();
            return ApiResponse::error('Server error', 500);
        }
    }

    public function returnBorrow(string $id): string
    {
        if ($resp = ApiAuth::requireToken()) return $resp;

        $borrowId = (int)$id;
        if ($borrowId <= 0) {
            return ApiResponse::error('Invalid id', 422, ['id' => 'id must be a positive integer']);
        }

        $pdo = DB::pdo();
        $pdo->beginTransaction();

        try {
            $s = $pdo->prepare("
                SELECT id, book_id, returned_at
                FROM borrows
                WHERE id = :id
                FOR UPDATE
            ");
            $s->execute(['id' => $borrowId]);
            $borrow = $s->fetch();

            if (!$borrow) {
                $pdo->rollBack();
                return ApiResponse::error('Borrow not found', 404);
            }

            if ($borrow['returned_at'] !== null) {
                $pdo->rollBack();
                return ApiResponse::error('Borrow already returned', 409);
            }

            $updBorrow = $pdo->prepare("UPDATE borrows SET returned_at = NOW() WHERE id = :id");
            $updBorrow->execute(['id' => $borrowId]);

            $updBook = $pdo->prepare("UPDATE books SET available = 1 WHERE id = :id");
            $updBook->execute(['id' => (int)$borrow['book_id']]);

            $pdo->commit();

            $fetch = $pdo->prepare("SELECT * FROM borrows WHERE id = :id LIMIT 1");
            $fetch->execute(['id' => $borrowId]);
            $updated = $fetch->fetch();

            return ApiResponse::success('Borrow returned', $updated ?: [
                'id' => $borrowId,
                'book_id' => (int)$borrow['book_id'],
            ]);
        } catch (\Throwable $e) {
            if ($pdo->inTransaction()) $pdo->rollBack();
            return ApiResponse::error('Server error', 500);
        }
    }

    public function renew(string $id): string
    {
        if ($resp = ApiAuth::requireToken()) return $resp;

        $borrowId = (int)$id;
        if ($borrowId <= 0) {
            return ApiResponse::error('Invalid id', 422, ['id' => 'id must be a positive integer']);
        }

        $body = $this->readJson();
        if (!$body) return ApiResponse::error('Invalid JSON body', 400);

        $extendDays = isset($body['extend_days']) ? (int)$body['extend_days'] : 7;
        if ($extendDays < 1 || $extendDays > 30) {
            return ApiResponse::error('Validation failed', 422, ['extend_days' => 'extend_days must be between 1 and 30']);
        }

        $pdo = DB::pdo();
        $pdo->beginTransaction();

        try {
            $s = $pdo->prepare("SELECT id, returned_at FROM borrows WHERE id = :id FOR UPDATE");
            $s->execute(['id' => $borrowId]);
            $borrow = $s->fetch();

            if (!$borrow) {
                $pdo->rollBack();
                return ApiResponse::error('Borrow not found', 404);
            }

            if ($borrow['returned_at'] !== null) {
                $pdo->rollBack();
                return ApiResponse::error('Cannot renew a returned borrow', 409);
            }

            $upd = $pdo->prepare("
                UPDATE borrows
                SET due_at = DATE_ADD(COALESCE(due_at, NOW()), INTERVAL :days DAY)
                WHERE id = :id
            ");
            $upd->bindValue(':days', $extendDays, PDO::PARAM_INT);
            $upd->bindValue(':id', $borrowId, PDO::PARAM_INT);
            $upd->execute();

            $pdo->commit();

            $fetch = $pdo->prepare("SELECT * FROM borrows WHERE id = :id LIMIT 1");
            $fetch->execute(['id' => $borrowId]);
            $updated = $fetch->fetch();

            return ApiResponse::success('Borrow renewed', $updated ?: [
                'id' => $borrowId,
                'extend_days' => $extendDays,
            ]);
        } catch (\Throwable $e) {
            if ($pdo->inTransaction()) $pdo->rollBack();
            return ApiResponse::error('Server error', 500);
        }
    }
}
