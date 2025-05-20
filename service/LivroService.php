<?php

namespace App\Service;

use App\Repository\LivroRepository;

class LivroService {
    private $repo;

   public function __construct(?LivroRepository $repo = null) {
        $this->repo = $repo ?? new LivroRepository();
    }

    public function listarLivros():array {
        return $this->repo->findAll();
    }

    public function obterLivro($id) {
        return $this->repo->find($id);
    }

    public function salvarLivro($dados) {
        $livro = new Livro();
        $livro->titulo = $dados['titulo'];
        $livro->autor = $dados['autor'];
        $livro->descricao = $dados['descricao'];
        return $this->repo->save($livro);
    }

    public function atualizarLivro($dados) {
        $livro = new Livro();
        $livro->id = $dados['id'];
        $livro->titulo = $dados['titulo'];
        $livro->autor = $dados['autor'];
        $livro->descricao = $dados['descricao'];
        return $this->repo->update($livro);
    }

    public function excluirLivro($id) {
        return $this->repo->delete($id);
    }
}