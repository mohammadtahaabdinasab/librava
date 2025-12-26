<?php
declare(strict_types=1);

define('BASE_PATH', dirname(__DIR__));

require BASE_PATH . '/core/autoload.php';

Core\Env::load(BASE_PATH);
Core\Config::load(BASE_PATH . '/config');

// Debug mode
if (Core\Config::get('app.debug', false)) {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
}
