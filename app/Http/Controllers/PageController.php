<?php

namespace App\Http\Controllers;

use App\Views\View;

class PageController extends Controller
{
    public function index()
    {
        View::render('index', []);
    }
}
