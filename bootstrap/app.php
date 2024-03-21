<?php
require __DIR__ . '/../vendor/autoload.php';

use Database\Database;

$config = [];
try {
    $config = include "../config/database.php";
} catch (Exception $e) {
    die('Error loading database configuration: ' . $e->getMessage());
}

if (empty($config)) {
    die('Database configuration is empty.');
}
try {
    $database = Database::connect($config);
} catch (Exception $e) {
    die('Error creating Database instance: ' . $e->getMessage());
}

use Core\TemplateEngine\Template;

new Template(__DIR__ . '/../web/view/');

use Core\Router\Router;

include __DIR__ . '/../routes/web.php';

echo Router::dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
