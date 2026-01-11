<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

use MVC\Core\Router;

$router = new Router();
$router->affiche();
