<?php
// public/index.php

session_start();
require __DIR__ . '/../bootstrap/app.php';

use Core\ValidationException;
use Core\Session;
use Core\Router;

$router = new Router();
include __DIR__ . '/../routes/web.php';

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

try {
    $router->dispatch($method, $url);
} catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    return redirect($router->previousUrl());
}

Session::unflash();