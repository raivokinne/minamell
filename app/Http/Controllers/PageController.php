<?php

namespace App\Http\Controllers;

use App\TemplateEngine\Template;

class PageController extends Controller
{
    public function index()
    {
        return Template::render('index', ['title' => 'Hello World']);
    }
}
