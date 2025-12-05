<?php

namespace Core;

abstract class Controller
{
    protected function view(string $path, array $data = [])
    {
        extract($data);
        require __DIR__ . '/../app/views/' . $path . '.php';
    }
}
