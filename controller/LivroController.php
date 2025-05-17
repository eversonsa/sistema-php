<?php
require_once 'service/LivroService.php';

class LivroController {
    private $service;

    public function __construct() {
        $this->service = new LivroService();
    }

    public function handleRequest() {
        $acao = $_GET['acao'] ?? 'listar';

        switch ($acao) {
            case 'listar':
                $livros = $this->service->listarLivros();
                include 'view/lista.php';
                break;
            case 'novo':
                include 'view/form.php';
                break;
            case 'editar':
                $livro = $this->service->obterLivro($_GET['id']);
                include 'view/form.php';
                break;
            case 'salvar':
                $this->service->salvarLivro($_POST);
                header('Location: index.php');
                break;
            case 'atualizar':
                $this->service->atualizarLivro($_POST);
                header('Location: index.php');
                break;
            case 'excluir':
                $this->service->excluirLivro($_GET['id']);
                header('Location: index.php');
                break;
        }
    }
}