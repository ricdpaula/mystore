<?php

require 'src/conexao.php';
require 'src/Modelo/Checkout.php';

session_id('carrinho');
session_start();

if(isset($_GET['remove'])){
    unset($_SESSION['produto-'.$_GET['remove']]);
}


$arrayValores = [];

foreach($_SESSION as $precos){
    array_push($arrayValores, $precos['preco'] * $precos['qtd']);
}

$valorFinal = number_format(array_sum($arrayValores), 2);

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
        <section class="container mt-2">
            <form action="#" method="POST">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Imagem</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION as $produto): ?>
                            <tr>
                                <td><img height="50px" src="<?= $produto['imagem'] ?>"></td>
                                <td><?= $produto['nome'] ?></td>
                                <td><?= $produto['descricao'] ?></td>
                                <td class="text-center"><?= $produto['qtd'] ?></td>
                                <td class="text-center"><?= number_format($produto['preco'], 2) * $produto['qtd'] ?></td>
                                <td><a class="btn btn-danger" href="checkout.php?remove=<?= $produto['id'] ?>">&times;</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <h5>Valor total: R$<span><?= $valorFinal ?></span></h5>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="sucesso.php" class="btn btn-dark">Finalizar compra</a>
                </div>
            </form>
        </section>
    </main>
</body>

</html>