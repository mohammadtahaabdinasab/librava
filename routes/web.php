<?php

use Core\Router;
use App\Controllers\HomeController;
use App\Controllers\AboutController;
use App\Controllers\ContactController;
use App\Controllers\BooksController;
use App\Controllers\CreatorController;

// Web routes
Router::add('GET', '/', function () {
    $controller = new HomeController();
    $controller->index();
});

Router::add('GET', '/about', function () {
    $controller = new AboutController();
    $controller->index();
});

Router::add('GET', '/contact', function () {
    $controller = new ContactController();
    $controller->index();
});

Router::add('GET', '/books', function () {
    $controller = new BooksController();
    $controller->index();
});

Router::add('GET', '/creator', function () {
    $controller = new CreatorController();
    $controller->index();
});

// Add more web routes as needed

