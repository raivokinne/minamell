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

    public function getConnection()
    {
        return $this->connection;
    }

    public function __destruct()
    {
        $this->connection = null;
    }
}
