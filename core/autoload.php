<?php
declare(strict_types=1);

spl_autoload_register(function (string $class) {

    $prefixes = [
        'Core\\' => BASE_PATH . '/core/',
        'App\\'  => BASE_PATH . '/app/',
    ];

    foreach ($prefixes as $prefix => $baseDir) {
        if (str_starts_with($class, $prefix)) {
            $relative = substr($class, strlen($prefix));
            $file = $baseDir . str_replace('\\', '/', $relative) . '.php';

            if (file_exists($file)) {
                require $file;
            }
        }
    }
});
