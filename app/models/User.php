<?php
namespace MVC\Models;

use PDO;

class User
{
    public static function create(string $email, string $password, float $budget = 0): bool
    {
        $pdo = Database::getConnection();

        
        $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$email]);
        if ($check->fetch()) {
            return false;
        }

       
        $stmt = $pdo->prepare("INSERT INTO users (email, password, budget) VALUES (?, ?, ?)");
        return $stmt->execute([
            $email,
            password_hash($password, PASSWORD_DEFAULT),
            $budget
        ]);
    }

    public static function findByEmail(string $email): ?array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    public static function findById(int $id): ?array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }
    // Update user budget
    public static function setBudget(int $userId, float $budget): bool
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("UPDATE users SET budget = ? WHERE id = ?");
        return $stmt->execute([$budget, $userId]);
    }
}
