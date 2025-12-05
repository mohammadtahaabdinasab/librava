<?php

namespace Core;

use PDO;
use Exception;

class Model
{
    protected static $pdo;

    protected static function db(): PDO
    {
        if (self::$pdo === null) {
            $config = require __DIR__ . '/../config/database.php';

            try {
                self::$pdo = new PDO(
                    $config['dsn'],
                    $config['user'],
                    $config['pass'],
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );
            } catch (Exception $e) {
                die('Database connection failed: ' . $e->getMessage());
            }
        }

        return self::$pdo;
    }

    protected static function query(string $sql, array $params = [])
    {
        $stmt = self::db()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public static function all(string $table)
    {
        $stmt = self::query("SELECT * FROM $table");
        return $stmt->fetchAll();
    }

    public static function findById(string $table, int $id)
    {
        $stmt = self::query("SELECT * FROM $table WHERE id = ?", [$id]);
        return $stmt->fetch();
    }
}
