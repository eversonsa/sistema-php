<a href="index.php?acao=novo">Novo Livro</a>
<table border="1">
    <tr><th>ID</th><th>Título</th><th>Autor</th><th>Ações</th></tr>
    <?php foreach ($livros as $livro): ?>
    <tr>
        <td><?= $livro->id ?></td>
        <td><?= $livro->titulo ?></td>
        <td><?= $livro->autor ?></td>
        <td><?= $livro->descricao ?></td>
        <td>
            <a href="index.php?acao=editar&id=<?= $livro->id ?>">Editar</a>
            <a href="index.php?acao=excluir&id=<?= $livro->id ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>