<?php

namespace App\Models;

use Database\Database;

class Model extends Database
{
    public static function getAll($tableName)
    {
        $query = "SELECT * FROM $tableName";
        $query = self::$connection->prepare($query);
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function insertIntoTable($tableName, $value)
    {
        $query = "INSERT INTO $tableName (value) VALUES (?)";
        $query = self::$connection->prepare($query);
        $query->execute([$value]);
    }

    public static function getIdFromTable($tableName, $value)
    {
        if (!$value) {
            return null;
        }
        $query = "SELECT id FROM $tableName WHERE value = ?";
        $query = self::$connection->prepare($query);
        $query->execute([$value]);
        return $query->fetchColumn();
    }
}
