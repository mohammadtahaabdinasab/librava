<?php

namespace App\Controllers;

use Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Librava - Modern Library Management System',
            'description' => 'The modern multilingual library management system with REST API',
            'keywords' => 'library, books, management, system',
        ];
        $this->renderWithLayout('home', $data);
    }
}
