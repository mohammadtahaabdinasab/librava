<?php
namespace Core;

abstract class Model
{
    protected static string $table;

    public static function all(): array
    {
        $table = static::$table;
        $stmt = DB::pdo()->query("SELECT * FROM `$table` ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $table = static::$table;
        $stmt = DB::pdo()->prepare("SELECT * FROM `$table` WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }
}
