<?php

namespace App\Infra; 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class AuthMiddleware {
    public static function verificar() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: view/login.php');
            exit;
        }
    }

    public static function verificarAdmin() {
        if ($_SESSION['usuario']['role'] !== 'admin') {
            echo "Acesso negado! Você não tem permissão para essa ação.";
            exit;
        }
    }
}