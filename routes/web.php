<?php

$router->get('/', 'HomeController@index');
$router->get('/books', 'BooksPageController@index');
$router->get('/books/{id}', 'BooksPageController@show');

$router->get('/about', 'PagesController@about');
$router->get('/contact', 'PagesController@contact');
$router->get('/developer', 'PagesController@developer');
