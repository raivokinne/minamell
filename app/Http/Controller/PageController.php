<?php

namespace App\Http\Controller;

use App\Http\Controller\Controller;
use App\Views\View;

class PageController extends Controller
{
    public function index()
    {
        return View::render('index');
    }

    public function about()
    {
        return 'about';
    }
}
