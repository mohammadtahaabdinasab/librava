<?php
namespace Core;

class Env
{
    public static function load(string $basePath): void
    {
        self::loadFile($basePath . '/.env');
        self::loadFile($basePath . '/.env.local');
    }

    private static function loadFile(string $path): void
    {
        if (!file_exists($path)) return;

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) continue;

            [$key, $value] = array_pad(explode('=', $line, 2), 2, '');
            $key = trim($key);
            $value = trim($value);
            $value = trim($value, "\"'");

            $_ENV[$key] = $value;
            putenv("$key=$value");
        }
    }

    public static function get(string $key, ?string $default = null): ?string
    {
        return $_ENV[$key] ?? getenv($key) ?: $default;
    }

    public static function bool(string $key, bool $default = false): bool
    {
        $v = strtolower((string)self::get($key, $default ? 'true' : 'false'));
        return in_array($v, ['1', 'true', 'yes', 'on'], true);
    }
}
