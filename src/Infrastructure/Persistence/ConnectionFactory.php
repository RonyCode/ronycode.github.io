<?php

namespace App\Educar\Infrastructure\Persistence;

use PDO;

abstract class ConnectionFactory
{
    private PDO $conn;

    public static function createConnection(): PDO
    {
        $serveName = 'localhost';
        $dbName = 'db_projeto';
        $dbUser = 'root';
        $dbPassword = '170286para';

        $pdo = new PDO(
            "mysql:root=$serveName;dbname=$dbName",
            "$dbUser",
            "$dbPassword"
        );
        $pdo->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
        $pdo->setAttribute(
            PDO::ATTR_DEFAULT_FETCH_MODE,
            PDO::FETCH_ASSOC
        );

        return $pdo;
    }
}