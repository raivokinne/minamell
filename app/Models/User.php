<?php

namespace App\Models;

class User extends Model
{
    public function getUser()
    {
        $query = "SELECT * FROM users";
        $result = $this->connection->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
}
