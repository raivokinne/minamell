<?php

const BASE_PATH = __DIR__ . '/../';
require __DIR__ . '/../vendor/autoload.php';
$config = require BASE_PATH . 'config/database.php';
use Minamell\Minamell\Container;
use Minamell\Minamell\App;

use Minamell\Minamell\Database;

$container = new Container();
$container->bind(Database::class, function () {
    $config = require BASE_PATH . 'config/database.php';

    return new Database($config);
});

App::setContainer($container);

