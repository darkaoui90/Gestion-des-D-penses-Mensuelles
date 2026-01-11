<?php
namespace MVC\Controllers;

use MVC\Models\Expense;
use MVC\Models\User;

class DashboardController
{
    public function index(): void
    {
       
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $userId = (int) $_SESSION['user_id'];

        // Handle budget update
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['budget_amount'])) {
            $budgetAmount = (float) $_POST['budget_amount'];
            User::setBudget($userId, $budgetAmount);
            
            header('Location: index.php?page=dashboard');
            exit;
        }
        
        if (isset($_GET['delete'])) {
            $expenseId = (int) $_GET['delete'];
            Expense::delete($userId, $expenseId);

            header('Location: index.php?page=dashboard');
            exit;
        }

        $user = User::findById($userId);
        $totalBudget = isset($user['budget']) ? (float) $user['budget'] : 0.0;

        $totalSpent = Expense::getTotalByUser($userId);

        $remaining = $totalBudget - $totalSpent;
        if ($remaining < 0) {
            $remaining = 0;
        }

        
        $expenses = Expense::allByUser($userId); 

        
        require __DIR__ . '/../views/dashboard.php';
    }
}
