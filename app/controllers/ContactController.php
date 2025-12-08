<?php

namespace App\Controllers;

use Core\Controller;

class ContactController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Contact Us',
            'description' => 'Get in touch with the Librava team',
            'keywords' => 'contact, support, email, phone',
        ];
        $this->renderWithLayout('contact', $data);
    }
}
