<?php

use App\Http\Controllers\PageController;
use App\Http\Router\Router;

Router::get('/', [PageController::class, 'index']);
