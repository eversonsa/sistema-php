<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Controller\LivroController;

session_start();

// Redireciona para login se não estiver autenticado
if (!isset($_SESSION['usuario'])) {
    header('Location: view/form-login.php');
    exit;
}

$controller = new LivroController();
$controller->handleRequest();