<?php
namespace App\Controllers;

use Core\View;

class PagesController
{
    public function about(): string
    {
        return View::render('pages/about', [
            'title' => __('nav.about'),
        ]);
    }

    public function contact(): string
    {
        return View::render('pages/contact', [
            'title' => __('nav.contact'),
        ]);
    }

    public function developer(): string
    {
        return View::render('pages/developer', [
            'title' => __('nav.developer'),
        ]);
    }
}
