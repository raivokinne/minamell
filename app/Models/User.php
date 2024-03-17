<?php

namespace App\Models;

class User extends Model
{
    public function getUser(int $id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}
