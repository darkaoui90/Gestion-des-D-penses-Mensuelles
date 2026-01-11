<?php
namespace MVC\Models;

use PDO;

class Expense
{
    public static function create(int $userId, string $title, float $amount, string $date, int $categoryId): bool
    {
        if ($amount < 0) {
            return false;
        }

        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("
            INSERT INTO expenses (user_id, title, amount, date, category_id)
            VALUES (?, ?, ?, ?, ?)
        ");
        
        return $stmt->execute([$userId, $title, $amount, $date, $categoryId]);
    }

    public static function allByUser(int $userId): array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("
            SELECT e.*, c.name AS category_name
            FROM expenses e
            JOIN categories c ON c.id = e.category_id
            WHERE e.user_id = ?
            ORDER BY e.date DESC, e.id DESC
            LIMIT 6
        ");
        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 NUMBER 3 GOES HERE
    public static function getTotalByUser(int $userId): float
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("
            SELECT COALESCE(SUM(amount), 0) AS total
            FROM expenses
            WHERE user_id = ?
        ");
        $stmt->execute([$userId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return (float) ($row['total'] ?? 0);
    }

    public static function delete(int $userId, int $expenseId): bool
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("DELETE FROM expenses WHERE id = ? AND user_id = ?");
        return $stmt->execute([$expenseId, $userId]);
    }
}
