<?php

require 'vendor/autoload.php';
require 'helpers/helpers.php';

$config = require 'helpers/config.php';

use Framework\ErrorHandler;
use Framework\Model\Database;
use Framework\Router\Router;

set_error_handler([ErrorHandler::class, 'handleError']);
set_exception_handler([ErrorHandler::class, 'handleException']);

session_start();

$db = new Database($config);

$router = new Router();

require 'Framework/Router/routes.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->route($uri);

?>

<!DOCTYPE html>
<html lang="en">
<body>
</body>
</html>
