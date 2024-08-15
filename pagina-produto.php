<?php

require 'src/conexao.php';
require 'src/Modelo/Produto.php';
require 'src/Modelo/Checkout.php';
require 'src/Repositorio/ProdutoRepositorio.php';

session_id('carrinho');
session_start();

$produtoRepositorio = new ProdutoRepositorio($pdo);

if (isset($_GET['id'])) {
    $produto = $produtoRepositorio->buscarUm($_GET['id']);
}

if (isset($_POST['carrinho'])) {
    $produto = $produtoRepositorio->buscarUm($_POST['id']);
    $checkout = new Checkout();
    $checkout->inserirCheckout($produto, $_POST['qtd']);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | MyStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <main>
        <!-- Header -->
        <header class="text-center py-4 d-flex justify-content-around flex-wrap align-items-center">
            <div class="d-flex">
                <a href="/" class="h4 fw-bold logo">MyStore</a>
            </div>
            <div class="d-flex">
                <a href="checkout.php" class="bi bi-cart m-0 text-dark"><span class="badge text-bg-primary mx-1"><?= count($_SESSION) ?></span></a>
            </div>
        </header>
        <!-- banner principal -->
        <section class="banner-principal py-4 container-fluid text-center">
            <h1>Tudo o que você precisa está aqui</h1>
            <p>Em busca de lojas de eletrônicos? Então não precisa se preocupar, você está no lugar certo.</p>
        </section>
        <section class="container pt-5">
            <div class="row">
                <div class="col">
                    <figure class="figure">
                        <img src="<?= $produto->getImagemDiretorio() ?>" class="figure-img img-fluid rounded"
                            alt="<?= $produto->getNome() ?>">
                        <figcaption class="figure-caption">Imagem meramente ilustrativa.</figcaption>
                    </figure>
                </div>
                <div class="col">
                    <p class="h2"><?= $produto->getNome() ?></p>
                    <p><?= $produto->getDescricao() ?></p>
                    <div class="star d-flex h4 text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <p class="h4 text-success"><?= $produto->getPrecoFormatado() ?></p>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $produto->getID() ?>" />
                        <label for="qtd" class="form-label">Quantidade:</label>
                        <input type="number" name="qtd" id="qtd" class="form-control" min="1" max="99" value="1" required>
                        <button type="submit" name="carrinho" class="btn btn-primary mt-2 w-100">Colocar no
                            carrinho</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
</body>

</html>