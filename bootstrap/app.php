<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../database/Database.php';
$config = require __DIR__ . '/../config/database.php';

new Database($config);

use App\TemplateEngine\Template;

new Template(__DIR__ . '/../web/view/');

use App\Http\Router\Router;

include __DIR__ . '/../routes/web.php';

echo Router::dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
