<?php

namespace App\Views;

class View
{
    static function render($view, $data = [])
    {
        extract($data);
        require __DIR__ . '/../../view/templates/' . $view . '.php';
    }
}
