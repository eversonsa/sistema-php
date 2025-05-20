<?php
namespace App\Controller;

use App\Repository\UsuarioRepository;

class AuthController {

    private $repo;

    public function __construct(?UsuarioRepository $repo = null) {
        $this->repo = $repo ?? new UsuarioRepository();
    }

    public function login($email, $senha) {
        $usuario = $this->repo->buscarPorEmail($email);
        if ($usuario && password_verify($senha, $usuario->senha)) {
            session_start();
           $_SESSION['usuario'] = [
                'id' => $usuario->id,
                'nome' => $usuario->nome,
                'role' => $usuario->role
            ];
            header('Location: ../index.php');
            exit;
        } else {
            echo "Usuário ou senha inválido!";
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: view/form-login.php');
        exit;
    }
}
