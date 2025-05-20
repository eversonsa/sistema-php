<?php

namespace App\Repository;

use App\Model\Livro;
use App\Infra\Database;
use \PDO;

class LivroRepository {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function findAll() {
        $stmt = $this->conn->query("SELECT * FROM livros");
        return $stmt->fetchAll(PDO::FETCH_CLASS, Livro::class); // <<< corrigido aqui
    }

    public function find($id) {
        $stmt = $this->conn->prepare("SELECT * FROM livros WHERE id = ?");
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Livro::class); // <<< corrigido aqui
        return $stmt->fetch();
    }

    public function save(Livro $livro) {
        $stmt = $this->conn->prepare("INSERT INTO livros (titulo, autor, descricao) VALUES (?, ?, ?)");
        return $stmt->execute([$livro->titulo, $livro->autor, $livro->descricao]);
    }

    public function update(Livro $livro) {
        $stmt = $this->conn->prepare("UPDATE livros SET titulo = ?, autor = ?, descricao = ? WHERE id = ?");
        return $stmt->execute([$livro->titulo, $livro->autor, $livro->descricao, $livro->id]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM livros WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
