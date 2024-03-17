<?php

use App\Http\Controllers\PageController;
use App\Http\Router\Router;
use App\TemplateEngine\Template;

Router::get('/', [PageController::class, 'index']);

Router::get('/niggas', function () {
    return Template::render('niggas', [
        'title' => 'Niggas',
    ]);
});
