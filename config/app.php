<?php
use Core\Env;

return [
    'name' => 'Librava',
    'env' => Env::get('APP_ENV', 'production'),
    'debug' => Env::bool('APP_DEBUG', false),
    'default_lang' => Env::get('DEFAULT_LANG', 'en'),
];
