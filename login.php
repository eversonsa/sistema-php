<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Controller\AuthController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $authController = new AuthController();
    $authController->login($email, $senha);
}
