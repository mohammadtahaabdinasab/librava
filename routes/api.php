<?php
/** @var \Core\Router $router */

$router->get('/api/ping', 'Api\\PingController@index');

$router->get('/api/books', 'Api\\BooksController@index');
$router->get('/api/books/{id}', 'Api\\BooksController@show');
$router->post('/api/books', 'Api\\BooksController@store');
$router->put('/api/books/{id}', 'Api\\BooksController@update');
$router->delete('/api/books/{id}', 'Api\\BooksController@delete');

$router->get('/api/borrows', 'Api\\BorrowsController@index');
$router->get('/api/borrows/{id}', 'Api\\BorrowsController@show');
$router->post('/api/borrows', 'Api\\BorrowsController@store');
$router->post('/api/borrows/{id}/return', 'Api\\BorrowsController@returnBorrow');
$router->post('/api/borrows/{id}/renew', 'Api\\BorrowsController@renew');
