<?php
namespace Core;

use PDO;
use PDOException;

class DB
{
    private static ?PDO $pdo = null;

    public static function pdo(): PDO
    {
        if (self::$pdo !== null) {
            return self::$pdo;
        }

        $host = Config::get('database.host');
        $db   = Config::get('database.name');
        $user = Config::get('database.user');
        $pass = Config::get('database.pass');
        $charset = Config::get('database.charset', 'utf8mb4');

        $dsn = "mysql:host={$host};dbname={$db};charset={$charset}";

        try {
            self::$pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            http_response_code(500);

            if (Config::get('app.debug')) {
                die("DB Connection Failed: " . $e->getMessage());
            }

            die("DB Connection Failed.");
        }

        return self::$pdo;
    }
}
