<?php

namespace App\Http\Controllers;

use App\TemplateEngine\Template;
use App\Models\User;

class PageController extends Controller
{
    public function index()
    {
        $users = (new User())->getUser();
        return Template::render('index', ['users' => $users]);
    }
}
