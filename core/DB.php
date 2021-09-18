<?php

namespace app\core;

class DB
{
    public \PDO $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO(
            $_ENV['DB_DSN'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASSWORD'],
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ]
        );
    }
}