<?php

include __DIR__ . '/../app/Http/Router/Router.php';
include __DIR__ . '/../app/Http/Controller/PageController.php';

use App\Http\Router\Router;
use App\Http\Controller\PageController;

$router = new Router();

$router->get('/', [PageController::class, 'index']);
$router->get('/about', [PageController::class, 'about']);

echo $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
