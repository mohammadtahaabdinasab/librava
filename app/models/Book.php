<?php

namespace App\Models;

use Core\Model;

class Book extends Model
{
    public static function all(?string $table = null)
    {
        return parent::all($table);
    }

    public static function findById(int $id, string $table = null)
    {
        return parent::findById($id, $table);
    }
}
