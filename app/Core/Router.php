<?php

namespace MVC\Core;

use MVC\Controllers\AuthController;
use MVC\Controllers\DashboardController;

class Router
{
    public function affiche(): void
    {
        
        $page = $_GET['page'] ?? 'login';

        
        if (!isset($_SESSION['user_id']) && $page !== 'login') {
            header('Location: index.php?page=login');
            exit;
        }

        switch ($page) {
            case 'login':
                (new AuthController())->login();
                break;

            case 'logout':
                (new AuthController())->logout();
                break;

            case 'expenses':
                (new \MVC\Controllers\ExpenseController())->index();
                break;

            case 'dashboard':
                (new DashboardController())->index();
                break;
                
            default:
                header('Location: index.php?page=login');
                exit;
        }
    }
}
