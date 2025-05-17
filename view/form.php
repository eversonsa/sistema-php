<form method="post" action="index.php?acao=<?= isset($livro) ? 'atualizar' : 'salvar' ?>">
    <?php if (isset($livro)): ?>
        <input type="hidden" name="id" value="<?= $livro->id ?>">
    <?php endif; ?>
    <label>Título: <input type="text" name="titulo" value="<?= $livro->titulo ?? '' ?>"></label><br>
    <label>Autor: <input type="text" name="autor" value="<?= $livro->autor ?? '' ?>"></label><br>
    <label>Descrição:<br><textarea name="descricao"><?= $livro->descricao ?? '' ?></textarea></label><br>
    <button type="submit">Salvar</button>
    <a href="index.php">Voltar</a>
</form>
