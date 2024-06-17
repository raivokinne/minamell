<?php

namespace Core;

class Migrations
{
    public static function up()
    {
        $db = App::container()->resolve(Database::class);

        $connection = $db::$connection;

        $connection->exec(file_get_contents(__DIR__ . '/migrations/up.sql'));

        return true;
    }

    public static function down()
    {
        $db = App::container()->resolve(Database::class);

        $connection = $db::$connection;

        $connection->exec(file_get_contents(__DIR__ . '/migrations/down.sql'));

        return true;
    }
}

