<?php

require 'src/conexao.php';
require 'src/Modelo/Produto.php';
require 'src/Modelo/Checkout.php';
require 'src/Repositorio/ProdutoRepositorio.php';

session_id('carrinho');
session_start();

$produtoRepositorio = new ProdutoRepositorio($pdo);
$produtos = $produtoRepositorio->todosOsProdutos();

$tipo = '';

if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];
    $produtos = $produtoRepositorio->buscarPorFiltro($tipo);
} else {
    $produtos = $produtoRepositorio->todosOsProdutos();
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
        <nav class="d-flex justify-content-center pt-3">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link text-dark <?= $tipo == '' ? 'active' : '' ?>" href="index.php">Todos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark <?= $tipo == 'headphones' ? 'active' : '' ?>"
                        href="index.php?tipo=headphones">Headphones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark <?= $tipo == 'cabos' ? 'active' : '' ?>"
                        href="index.php?tipo=cabos">Cabos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark <?= $tipo == 'caixinhas' ? 'active' : '' ?>"
                        href="index.php?tipo=caixinhas">Caixinhas</a>
                </li>
            </ul>
        </nav>
        <section class="container mt-2">
            <div class="d-flex flex-wrap justify-content-center">
                <?php foreach ($produtos as $produto): ?>
                    <div class="card m-2" style="width: 18rem;">
                        <img src="<?= $produto->getImagemDiretorio() ?>" class="card-img-top"
                            alt="<?= $produto->getNome() ?>">
                        <div class="card-body">
                            <h6 class="card-title"><?= $produto->getNome() ?></h6>
                            <!-- <p class="card-text"><?= $produto->getDescricao() ?></p> -->
                            <h6 class="card-text text-success"><?= $produto->getPrecoFormatado() ?></h6>
                            <div class="d-flex mt-2">
                                <a href="pagina-produto.php?id=<?= $produto->getID() ?>" class="btn btn-dark"><i
                                        class="bi bi-search"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
</body>

</html>