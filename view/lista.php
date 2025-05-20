<?php

use App\Infra\AuthMiddleware;
use App\Controller\LivroController;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lista de Livros</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">

    <!-- Cabeçalho com saudação e logout -->
    <header class="flex justify-between items-center mb-6">
        <div>
            <?php if (isset($_SESSION['usuario'])): ?>
                <p class="text-gray-700 text-lg">
                    Olá, <strong><?= htmlspecialchars($_SESSION['usuario']['nome']) ?></strong> 
                    (<?= htmlspecialchars($_SESSION['usuario']['role']) ?>)
                </p>
            <?php endif; ?>
        </div>
        <a href="../logout.php" 
           class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded shadow">
           Sair
        </a>
    </header>

    <a href="index.php?acao=novo" 
       class="inline-block mb-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
       Novo Livro
    </a>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Título</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Autor</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Descrição</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($livros as $livro): ?>
            <tr class="hover:bg-gray-100">
                <td class="border border-gray-300 px-4 py-2"><?=$livro->id?></td>
                <td class="border border-gray-300 px-4 py-2"><?=$livro->titulo?></td>
                <td class="border border-gray-300 px-4 py-2"><?=$livro->autor?></td>
                <td class="border border-gray-300 px-4 py-2"><?=$livro->descricao ?></td>
                <td class="border border-gray-300 px-4 py-2 space-x-2">
                    <a href="index.php?acao=editar&id=<?=$livro->id?>" 
                       class="text-blue-600 hover:text-blue-800">Editar</a>
                    <?php if( $_SESSION['usuario']['role'] == 'admin' ): ?>
                        <a href="index.php?acao=excluir&id=<?=$livro->id?>" 
                        onclick="return confirm('Tem certeza?')"
                        class="text-red-600 hover:text-red-800">Excluir</a>
                     <?php endif; ?>   
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

</body>
</html>