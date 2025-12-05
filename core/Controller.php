<?php

namespace Core;

abstract class Controller
{
    protected string $lang = 'en';
    protected string $dir = 'ltr';

    public function __construct()
    {
        $this->lang = getCurrentLang();
        $this->dir = getDirection($this->lang);
    }

    protected function view(string $path, array $data = [])
    {
        $data['lang'] = $this->lang;
        $data['dir'] = $this->dir;
        extract($data);
        require __DIR__ . '/../app/views/' . $path . '.php';
    }
}
