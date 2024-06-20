<?php

session_start();
require __DIR__ . '/../bootstrap/app.php';

use Minamell\Minamell\Functions\Functions;
use Minamell\Minamell\ValidationException;
use Minamell\Minamell\Session;
use Minamell\Minamell\Router;


$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

include __DIR__ . '/../routes/web.php';

try {
	Router::dispatch($method, $url);
} catch (ValidationException $exception) {
	Session::flash('errors', $exception->errors);
	Session::flash('old', $exception->old);

	return Functions::redirect(Router::previousUrl());
}

Session::unflash();
