<?php
namespace MVC\Models;

use PDO;

class Category
{
    public static function all(): array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT id, name FROM categories ORDER BY name ASC");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
