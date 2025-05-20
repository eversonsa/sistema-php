<?php
namespace App\Controller;

use App\Repository\UsuarioRepository;
use App\Infra\LoggerFactory;

class AuthController {

    private $repo;
    private $logger;

    public function __construct(?UsuarioRepository $repo = null) {
        $this->repo = $repo ?? new UsuarioRepository();
         $this->logger = LoggerFactory::create('auth');
    }

    public function login($email, $senha) {
         $this->logger->info('Iniciando login para usuario de email', ['email' => $email] );
        $usuario = $this->repo->buscarPorEmail($email);
        if ($usuario && password_verify($senha, $usuario->senha)) {
            $this->logger->info('Preenchendo a info da sessao do usuario',['usuario' => $usuario]);
            session_start();
           $_SESSION['usuario'] = [
                'id' => $usuario->id,
                'nome' => $usuario->nome,
                'role' => $usuario->role
            ];
             $this->logger->info('Login realizado com sucesso', ['email' => $email]);
            header('Location: ../index.php');
            exit;
        } else {
             $this->logger->warning('Tentativa de login falhou', ['email' => $email]);
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
