<?php

namespace App\Repository;

use App\infra\Database;
use App\Model\Usuario;
use \PDO;

class UsuarioRepository {
   private PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

 public function buscarPorEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);

        // Configura para retornar um objeto da classe Usuario
        $stmt->setFetchMode(PDO::FETCH_CLASS, Usuario::class);
        return $stmt->fetch(); // retorna um objeto ou false
    }

    public function salvar(Usuario $usuario): bool
    {
        $sql = "INSERT INTO usuarios (nome, email, senha, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $usuario->nome,
            $usuario->email,
            $usuario->senha,
            $usuario->role
        ]);
    }

    private function mapearParaUsuario(array $dados): Usuario
    {
        $usuario = new Usuario();
        $usuario->id = $dados['id'];
        $usuario->nome = $dados['nome'];
        $usuario->email = $dados['email'];
        $usuario->senha = $dados['senha'];
        $usuario->role = $dados['role'];
        $usuario->criado_em = $dados['criado_em'];
        return $usuario;
    }    
}