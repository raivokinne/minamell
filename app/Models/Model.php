<?php

namespace App\Models;

use Database\Database;

abstract class Model extends Database
{
    public function __construct()
    {
        $config = require __DIR__ . '/../../config/database.php';
        parent::__construct($config);
    }
}
