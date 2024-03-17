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

        $file = preg_replace_callback('/@include\([\'"]([^\'"]+)[\'"]\)/', function ($matches) use ($data) {
            $includeName = trim($matches[1]);
            return self::render($includeName, $data);
        }, $file);

        extract($data);

        $file = preg_replace_callback('/@foreach\((.+?) as (.+?)\)(.*?)@endforeach/s', function ($matches) use (&$data) {
            $arrayName = $matches[1];
            $itemName = $matches[2];

            if (!isset($data[$arrayName]) || !is_array($data[$arrayName])) {
                echo 'Array not found: ' . $arrayName;
            }

            $sectionContent = $matches[3];
            $output = '';

            foreach ($data[$arrayName] as $item) {
                $data[$itemName] = $item;

                $output .= preg_replace_callback('/\{\{\s*(.+?)\s*\}\}/', function ($matches) use ($data) {
                    $value = trim($matches[1]);
                    return isset($data[$value]) ? $data[$value] : '';
                }, $sectionContent);
            }

            return $output;
        }, $file);


        $file = preg_replace_callback('/\{\{\s*([^{}]+)\s*\}\}/', function ($matches) use ($data) {
            $value = trim($matches[1]);
            return isset($data[$value]) ? $data[$value] : '';
        }, $file);

        ob_start();
        $tempFilePath = tempnam(sys_get_temp_dir(), 'tpl');
        file_put_contents($tempFilePath, $file);
        include $tempFilePath;
        unlink($tempFilePath);
        return ob_get_clean();
    }
}
