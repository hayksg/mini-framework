<?php

// Front controller

// Settings
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Including files
define('ROOT', __DIR__ . '/../');
require_once(ROOT . 'Application/Components/Router.php');

// Router's invoke
(new Router())->run();
