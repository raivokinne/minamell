<?php

namespace App\Http\Controllers;

use App\Views\View;

class PageController extends Controller
{
    public function index()
    {
        return View::render('index', ['title' => 'Hello World'], 'layout');
    }
}
