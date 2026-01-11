<?php
namespace MVC\Controllers;

use MVC\Models\Expense;
use MVC\Models\Category;

class ExpenseController
{
    public function index(): void
    {
        
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $userId = (int) $_SESSION['user_id'];

        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title       = $_POST['title'] ?? '';
            $amount      = (float) ($_POST['amount'] ?? 0);
            $date        = $_POST['date'] ?? date('Y-m-d');
            $categoryId  = (int) ($_POST['category_id'] ?? 0);

            if ($title !== '' && $amount >= 0) {
                Expense::create($userId, $title, $amount, $date, $categoryId);
            }

            
            header('Location: index.php?page=expenses');
            exit;
        }

        
        if (isset($_GET['delete'])) {
            $expenseId = (int) $_GET['delete'];
            Expense::delete($userId, $expenseId);

            header('Location: index.php?page=expenses');
            exit;
        }

        
        $expenses = Expense::allByUser($userId);

        
        $categories = Category::all();

        require __DIR__ . '/../views/expenses.php';
    }
}
