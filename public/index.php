<?php
declare(strict_types=1);

require dirname(__DIR__) . '/core/bootstrap.php';

session_start();

require BASE_PATH . '/core/Lang.php';
\Core\Lang::init();

require BASE_PATH . '/core/helpers.php';

$router = new Core\Router();

require BASE_PATH . '/routes/api.php';
require BASE_PATH . '/routes/web.php';

require BASE_PATH . '/core/ErrorHandler.php';
\Core\ErrorHandler::register();


$router->dispatch();
