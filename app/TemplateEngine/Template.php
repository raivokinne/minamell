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

        // Find and process @section directives
        $file = preg_replace_callback('/@section\([\'"]([^\'"]+)[\'"]\)(.*?)@endsection/s', function ($matches) {
            $sectionName = trim($matches[1]);
            $sectionContent = trim($matches[2]);
            // Store the section content
            self::$sections[$sectionName] = $sectionContent;
            return '';
        }, $file);

        // Find and process @extends directive
        if (preg_match('/@extends\([\'"]([^\'"]+)[\'"]\)/', $file, $matches)) {
            $parentTemplate = trim($matches[1]);
            // Render the parent template first
            $file = self::render($parentTemplate, $data);
        }

        // Replace @yield directives with content from @section directives
        $file = preg_replace_callback('/@yield\([\'"]([^\'"]+)[\'"]\)/', function ($matches) {
            $yieldName = trim($matches[1]);
            return isset(self::$sections[$yieldName]) ? self::$sections[$yieldName] : '';
        }, $file);

        // Extract data variables
        extract($data);

        // Start output buffering to capture the rendered template content
        ob_start();
        eval('?>' . $file); // Evaluate the template file
        return ob_get_clean();
    }
}
