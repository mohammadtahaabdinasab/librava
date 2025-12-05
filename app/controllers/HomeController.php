<?php

namespace App\Controllers;

use Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data = ['title' => 'Welcome', 'message' => 'Welcome to Librava'];
        $this->view('home', $data);
    }
}
