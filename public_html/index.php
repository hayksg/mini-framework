<?php

use Application\Components\Router;
use Application\Components\FunctionsLibrary;

// Front controller

// Settings
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Including files
define('ROOT', __DIR__ . '/../');
require_once(ROOT . 'config/autoload.php');

// Catch all Exceptions
set_exception_handler([new FunctionsLibrary, 'catchAllExceptions']);

// Router's invoke
(new Router())->run();
