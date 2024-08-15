<?php

require 'src/conexao.php';
require 'src/Modelo/Produto.php';
require 'src/Repositorio/ProdutoRepositorio.php';

session_id('admin');
session_start();

$produtoRepositorio = new ProdutoRepositorio($pdo);

if(isset($_POST['editar'])){
    $produtoEditado = new Produto($_POST['id'], $_POST['tipo'], $_POST['nome'], $_POST['descricao'], $_POST['preco']);

    if(isset($_FILES['imagem'])){
        $produtoEditado->setImagem(uniqid().$_FILES['imagem']['name']);
        move_uploaded_file($_FILES['imagem']['tmp_name'], $produtoEditado->getImagemDiretorio());
    }

    $produtoRepositorio->editar($produtoEditado);

}else{
    $produto = $produtoRepositorio->buscarUm($_GET['id']);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar produto | MyStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <main>
        <!-- Header -->
        <header class="text-center py-4 d-flex justify-content-around flex-wrap align-items-center">
            <a href="/" class="h4 fw-bold logo">MyStore</a>
            <p class="p-0 m-0">Seja bem-vindo(a) <b><?= $_SESSION['admin_nome'] ?></b></p>
        </header>
        <section class="d-flex justify-content-center py-5">
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $produto->getID() ?>"/>
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo:</label>
                    <select class="form-select" name="tipo" id="tipo" required>
                        <option value="headphones" <?= $produto->getTipo() == 'headphones' ? 'selected':'' ?>>Headphones</option>
                        <option value="cabos" <?= $produto->getTipo() == 'cabos' ? 'selected':'' ?>>Cabos</option>
                        <option value="caixinhas" <?= $produto->getTipo() == 'caixinhas' ? 'selected':'' ?>>Caixinhas</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="<?= $produto->getNome() ?>" required>
                </div>
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição:</label>
                    <textarea name="descricao" id="descricao" class="form-control" rows="5" required><?= $produto->getDescricao() ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="imagem" class="form-label">Imagem:</label>
                    <input type="file" name="imagem" id="imagem">
                </div>
                <div class="mb-3">
                    <label for="preco" class="form-label">Preço:</label>
                    <input type="text" name="preco" id="preco" value="<?= number_format($produto->getPreco(), 2) ?>" required>
                </div>
                <div class="mb-3">
                    <button type="submit" name="editar" class="btn btn-dark">Editar produto</button>
                </div>
            </form>
        </section>
    </main>
</body>

</html>