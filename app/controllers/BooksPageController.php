<?php
namespace App\Controllers;

use Core\View;

class BooksPageController
{
    public function index(): string
    {
        return View::render('pages/books', [
            'title' => __('nav.books'),
        ]);
    }

    public function show(array $params): string
    {
        $id = (int)($params['id'] ?? 0);

        return View::render('pages/book_show', [
            'title' => __('nav.books'),
            'book_id' => $id,
        ]);
    }
}
