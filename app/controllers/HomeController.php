<?php
namespace App\Controllers;

use Core\View;

class HomeController
{
    public function index(): string
    {
        return View::render('pages/home', [
            'title' => 'خانه',
        ]);
    }
}
