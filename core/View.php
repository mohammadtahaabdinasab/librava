<?php
namespace Core;

class View
{
    public static function render(string $view, array $data = []): string
    {
        $viewFile = BASE_PATH . '/app/views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            http_response_code(500);
            return "View not found: " . htmlspecialchars($view);
        }

        extract($data);

        ob_start();
        require $viewFile;
        return ob_get_clean();
    }
}
