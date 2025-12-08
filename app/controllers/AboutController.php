<?php

namespace App\Controllers;

use Core\Controller;

class AboutController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'About Librava',
            'description' => 'Learn about Librava - our mission, vision, and team',
            'keywords' => 'about, mission, team, librava',
        ];
        $this->renderWithLayout('about', $data);
    }
}
