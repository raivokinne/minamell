<?php

namespace Database;

class Migrations
{
    public static function up()
    {
        $db = new Database();

        $connection = $db::$connection;

        $connection->exec(file_get_contents(__DIR__ . '/migrations/up.sql'));

        return true;
    }

    public static function down()
    {
        $db = new Database();

        $connection = $db::$connection;

        $connection->exec(file_get_contents(__DIR__ . '/migrations/down.sql'));

        return true;
    }
}
