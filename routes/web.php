<?php

use Core\Router\Router;

Router::get('/', function () {
    return 'Hello World';
});
