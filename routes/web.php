<?php
require __DIR__ . '/../app/Http/Router/Router.php';

use App\Http\Router\Router;

Router::get('/', function () {
    return 'Hello World';
});
