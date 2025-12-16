<?php

// Minimal env loader and helper for Librava
if (!function_exists('env')) {
    function env(string $key, $default = null)
    {
        static $loaded = false;

        if (getenv($key) !== false) {
            return getenv($key);
        }

        if (isset($_ENV[$key])) {
            return $_ENV[$key];
        }

        // Load .env and .env.local once (priority: .env.local > .env)
        if (!$loaded) {
            $loaded = true;
            $base = realpath(__DIR__ . '/..');
            $envFiles = [
                $base . '/.env',
                $base . '/.env.local',
            ];

            foreach ($envFiles as $file) {
                if (!file_exists($file)) {
                    continue;
                }
                $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($lines as $line) {
                    $line = trim($line);
                    if ($line === '' || strpos($line, '#') === 0) {
                        continue;
                    }
                    if (strpos($line, '=') === false) {
                        continue;
                    }
                    [$k, $v] = array_map('trim', explode('=', $line, 2));
                    $v = trim($v, "\"' ");
                    // .env.local should override .env because it is read second
                    if (!array_key_exists($k, $_ENV) || $file === $base . '/.env.local') {
                        $_ENV[$k] = $v;
                        putenv(sprintf('%s=%s', $k, $v));
                    }
                }
            }
        }

        return $_ENV[$key] ?? $default;
    }
}

// Helper to get text direction based on language
if (!function_exists('getDirection')) {
    function getDirection(string $lang = null): string
    {
        $lang = $lang ?? env('DEFAULT_LANG', 'en');
        return in_array($lang, ['fa', 'ar', 'ur', 'he']) ? 'rtl' : 'ltr';
    }
}

// Helper to get current language
if (!function_exists('getCurrentLang')) {
    function getCurrentLang(): string
    {
        return $_GET['lang'] ?? $_SESSION['lang'] ?? env('DEFAULT_LANG', 'en');
    }
}

// Helper to get translation string by key
if (!function_exists('trans')) {
    function trans(string $key, string $lang = null, $default = null)
    {
        $lang = $lang ?? getCurrentLang();
        
        // Load translation file for the language
        $translationFile = realpath(__DIR__ . '/../resources/lang/' . $lang . '.php');
        
        if (!file_exists($translationFile)) {
            // Fall back to English if language file doesn't exist
            $translationFile = realpath(__DIR__ . '/../resources/lang/en.php');
        }
        
        if (!file_exists($translationFile)) {
            return $default ?? $key;
        }
        
        $translations = require $translationFile;
        
        // Support nested keys like 'nav.home'
        $keys = explode('.', $key);
        $value = $translations;
        
        foreach ($keys as $k) {
            if (is_array($value) && isset($value[$k])) {
                $value = $value[$k];
            } else {
                return $default ?? $key;
            }
        }
        
        return $value;
    }
}

// Helper to get translated text and echo it
if (!function_exists('t')) {
    function t(string $key, string $lang = null, $default = null): void
    {
        echo htmlentities(trans($key, $lang, $default));
    }
}

