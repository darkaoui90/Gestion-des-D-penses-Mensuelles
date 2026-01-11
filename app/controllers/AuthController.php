<?php
namespace MVC\Controllers;

use MVC\Models\User;

class AuthController
{
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $action = $_POST['action'] ?? ''; 

            // LOGIN
            if ($action === 'login') {
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';

                $user = User::findByEmail($email);

                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    header('Location: index.php?page=dashboard');
                    exit;
                }

                $error = "Email ou mot de passe incorrect";
            }

            // REGISTER
            if ($action === 'register') {
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';

                if ($email !== '' && $password !== '') {
                    User::create($email, $password);
                } else {
                    $error = "Remplis tous les champs";
                }
            }
        }

        require __DIR__ . '/../views/login.php';
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: index.php?page=login');
        exit;
    }
}
