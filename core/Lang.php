<?php
namespace Core;

class Lang
{
    private static array $dict = [];
    private static string $locale = 'fa';

    public static function init(): void
    {
        $default = (string)Config::get('app.default_lang', 'fa');

        $locale = $_GET['lang'] ?? ($_SESSION['lang'] ?? $default);
        $locale = in_array($locale, ['fa', 'en'], true) ? $locale : $default;

        self::$locale = $locale;
        $_SESSION['lang'] = $locale;

        $file = BASE_PATH . "/resources/lang/{$locale}.php";
        self::$dict = is_file($file) ? (require $file) : [];
    }

    public static function getLocale(): string
    {
        return self::$locale;
    }

    public static function dir(): string
    {
        return self::$locale === 'fa' ? 'rtl' : 'ltr';
    }

    public static function t(string $key, array $replace = []): string
    {
        $text = self::$dict[$key] ?? $key;

        foreach ($replace as $k => $v) {
            $text = str_replace(':' . $k, (string)$v, $text);
        }

        return $text;
    }
}
