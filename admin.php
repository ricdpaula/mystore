<?php

require 'src/conexao.php';
require 'src/Modelo/Produto.php';
require 'src/Modelo/Checkout.php';
require 'src/Repositorio/ProdutoRepositorio.php';

session_id('admin');
session_start();

if (!isset($_SESSION['logado'])) {
    header('location: login.php');
    exit;
}

if (isset($_GET['sair'])) {
    unset($_SESSION['logado']);
    header('location: login.php');
    exit;
}

$produtoRepositorio = new ProdutoRepositorio($pdo);
$produtos = $produtoRepositorio->todosOsProdutos();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | MyStore</title>
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
            <p class="p-0 m-0">Seja bem-vindo(a) <b><?= $_SESSION['admin_nome'] ?></b> <a class="text-dark"
                    href="admin.php?sair">sair</a></p>
        </header>
        <section class="d-flex justify-content-center py-5 px-5">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Preco</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produtos as $produto): ?>
                        <tr>
                            <th scope="row"><?= $produto->getID() ?></th>
                            <td><?= $produto->getTipo() ?></td>
                            <td><?= $produto->getNome() ?></td>
                            <td><?= $produto->getDescricao() ?></td>
                            <td><?= $produto->getPrecoFormatado() ?></td>
                            <td>
                                <a href="editar-produto.php?id=<?= $produto->getID() ?>" class="btn btn-warning">Editar</a>
                                <a href="excluir-produto.php?id=<?= $produto->getID() ?>" class="btn btn-danger">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
        <section class="d-flex justify-content-center">
            <a href="cadastrar-produto.php" class="btn btn-dark">Cadastrar Produto</a>
        </section>
    </main>
</body>

</html>