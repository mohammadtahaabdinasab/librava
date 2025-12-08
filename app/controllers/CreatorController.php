<?php

namespace App\Controllers;

use Core\Controller;

class CreatorController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Meet the Creator',
            'description' => 'Learn about Mohammad Taha and the Librava team',
            'keywords' => 'creator, author, team, contributors',
        ];
        $this->renderWithLayout('creator', $data);
    }
}
