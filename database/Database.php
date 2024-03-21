<?php

namespace Database;

use PDO;

class Database
{
    public static $connection;

    public static function connect($config)
    {
        if (!$config) {
            die('config not found');
        }

        $dsn = $config['driver'] . ":host=" . $config['host'] . ";dbname=" . $config['database'] . ";charset=" . $config['charset'];

        try {
            self::$connection = new PDO($dsn, $config['username'], $config['password']);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$connection;
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
}
