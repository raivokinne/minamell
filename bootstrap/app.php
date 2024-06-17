<?php

const APP_URL = 'http://localhost:8000';
const BASE_PATH = __DIR__ . '/../';
require __DIR__ . '/../vendor/autoload.php';
require BASE_PATH . 'core/functions.php';
$config = require BASE_PATH . 'config/database.php';
use Core\Container;
use Core\App;

use Core\Database;

$container = new Container();
$container->bind(Database::class, function () {
    $config = require BASE_PATH . 'config/database.php';

    return new Database($config);
});

App::setContainer($container);


