<?php

class Database
{
    private $connection = null;

    public function __construct($config = [])
    {
        $dsn = $config['driver'] . ':host=' . $config['host'] . ';port=' . $config['port'] . ';dbname=' . $config['database'];
        $this->connection = new PDO($dsn, $config['username'], $config['password']);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function execute($stmt, $params = [])
    {
        $query = $this->connection->prepare($stmt);
        $query->execute($params);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
