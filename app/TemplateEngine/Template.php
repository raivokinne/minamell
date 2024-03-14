<?php

namespace App\TemplateEngine;

class Template
{
    public static $path;
    public static $sections = [];

    public function __construct($path)
    {
        self::$path = $path;
    }

    public static function render($template, $data = [])
    {
        $path = self::$path . $template . '.php';
        if (!file_exists($path)) {
            echo 'File not found: ' . $path;
            throw new \Exception('Template not found: ' . $path);
        }

        $file = file_get_contents($path);

        $file = preg_replace_callback('/@section\([\'"]([^\'"]+)[\'"]\)(.*?)@endsection/s', function ($matches) {
            $sectionName = trim($matches[1]);
            $sectionContent = trim($matches[2]);
            self::$sections[$sectionName] = $sectionContent;
            return '';
        }, $file);

        if (preg_match('/@extends\([\'"]([^\'"]+)[\'"]\)/', $file, $matches)) {
            $parentTemplate = trim($matches[1]);
            $file = self::render($parentTemplate, $data);
        }

        $file = preg_replace_callback('/@yield\([\'"]([^\'"]+)[\'"]\)/', function ($matches) {
            $yieldName = trim($matches[1]);
            return isset(self::$sections[$yieldName]) ? self::$sections[$yieldName] : '';
        }, $file);

        extract($data);

        ob_start();
        eval('?>' . $file);
        return ob_get_clean();
    }
}
