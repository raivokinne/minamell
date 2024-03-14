<?php

namespace App\Views;

class View
{
    static function render($view, $data = [], $layout = null)
    {
        if (!file_exists(__DIR__ . '/../../web/view/' . $view . '.php')) {
            throw new \Exception(sprintf('The file %s could not be found.', $view));
        }
        extract($data);

        if ($layout !== null) {
            ob_start();
            include __DIR__ . '/../../web/view/' . $layout . '.php';
            $layoutContent = ob_get_clean();
        } else {
            $layoutContent = '';
        }

        ob_start();
        include __DIR__ . '/../../web/view/' . $view . '.php';
        $viewContent = ob_get_clean();

        echo str_replace('@content', $viewContent, $layoutContent);
    }
}
