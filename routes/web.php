<?php

use Core\Router;
use App\Controllers\HomeController;

// Web routes
Router::add('GET', '/', function () {
    $controller = new HomeController();
    $controller->index();
});

// Add more web routes here as needed

