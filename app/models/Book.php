<?php

namespace App\Models;

use Core\Model;

class Book extends Model
{
    public static function all()
    {
        return parent::all('books');
    }

    public static function findById(int $id)
    {
        return parent::findById('books', $id);
    }
}
