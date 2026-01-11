<?php
namespace MVC\Models;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $pdo = null;    

    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO(
                    "mysql:host=localhost;dbname=wallet_app;charset=utf8",
                    "root",
                    "root",
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                die("Database error: " . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}
