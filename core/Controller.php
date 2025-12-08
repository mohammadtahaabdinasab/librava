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

    protected function renderWithLayout(string $path, array $data = [])
    {
        $data['lang'] = $this->lang;
        $data['dir'] = $this->dir;
        
        // Render the view to a variable
        ob_start();
        extract($data);
        require __DIR__ . '/../app/views/' . $path . '.php';
        $content = ob_get_clean();
        
        // Add content to data array
        $data['content'] = $content;
        
        // Render the layout with content
        extract($data);
        require __DIR__ . '/../app/views/layout.php';
    }
}
