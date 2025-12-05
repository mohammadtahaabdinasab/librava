<?php

namespace Core;

use PDO;
use Exception;

class Model
{
    protected static $pdo;
    protected static $mockData = [];

    protected static $usesMock = false;

    protected static function db()
    {
        if (self::$pdo === null) {
            $config = require __DIR__ . '/../config/database.php';

            try {
                self::$pdo = new PDO(
                    $config['dsn'],
                    $config['user'] ?? '',
                    $config['pass'] ?? '',
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );
            } catch (Exception $e) {
                $msg = $e->getMessage();
                
                // If no database driver is available, use mock in-memory data
                if (stripos($msg, 'could not find driver') !== false || 
                    stripos($msg, 'no such file') !== false) {
                    // Initialize mock data on first error
                    if (empty(self::$mockData)) {
                        self::$mockData = [
                            'books' => [
                                ['id' => 1, 'title' => '1984', 'author' => 'George Orwell', 'published_year' => 1949],
                                ['id' => 2, 'title' => 'To Kill a Mockingbird', 'author' => 'Harper Lee', 'published_year' => 1960],
                                ['id' => 3, 'title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald', 'published_year' => 1925],
                            ]
                        ];
                    }
                    self::$usesMock = true;
                    return null;
                }

                die('Database connection failed: ' . $msg);
            }
        }

        return self::$pdo;
    }

    protected static function query(string $sql, array $params = [])
    {
        $pdo = self::db();
        
        // Mock mode fallback if no PDO driver available
        if ($pdo === null || self::$usesMock) {
            return new MockStatement($sql, $params, self::$mockData);
        }
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public static function all(?string $table = null)
    {
        if (empty($table)) {
            $table = static::inferTable();
        }
        
        // Mock mode
        if (self::$usesMock || self::db() === null) {
            return self::$mockData[$table] ?? [];
        }
        
        $stmt = self::query("SELECT * FROM $table");
        return $stmt->fetchAll();
    }

    public static function findById(int $id, string $table = null)
    {
        if (empty($table)) {
            $table = static::inferTable();
        }
        
        // Mock mode
        if (self::$usesMock || self::db() === null) {
            $data = self::$mockData[$table] ?? [];
            foreach ($data as $row) {
                if ($row['id'] == $id) {
                    return $row;
                }
            }
            return null;
        }
        
        $stmt = self::query("SELECT * FROM $table WHERE id = ?", [$id]);
        return $stmt->fetch();
    }

    protected static function inferTable(): string
    {
        $called = get_called_class();
        $parts = explode('\\', $called);
        $short = end($parts);
        return strtolower($short) . 's';
    }
}

// Mock PDO Statement for when database driver is not available
class MockStatement
{
    private $sql;
    private $params;
    private $data;

    public function __construct(string $sql, array $params, array $data)
    {
        $this->sql = $sql;
        $this->params = $params;
        $this->data = $data;
    }

    public function fetchAll()
    {
        return [];
    }

    public function fetch()
    {
        return null;
    }
}
