<?php

namespace App\Controllers;

use Core\Controller;

class BooksController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Browse Books',
            'description' => 'Browse and search our library collection',
            'keywords' => 'books, library, browse, search',
        ];
        $this->renderWithLayout('books', $data);
    }
}
