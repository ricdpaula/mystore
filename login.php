<?php

require 'src/conexao.php';
require 'src/Repositorio/AdminRepositorio.php';

$adminRepositorio = new AdminRepositorio($pdo);

if(isset($_POST['logar'])){
    $adminRepositorio->login($_POST['usuario'], $_POST['senha']);
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
        </header>
        <section class="d-flex justify-content-center py-5">
            <form method="POST">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario:</label>
                    <input type="text" name="usuario" id="usuario" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha:</label>
                    <input type="password" name="senha" id="senha" class="form-control" required />
                </div>
                <div class="mb-3">
                    <button type="submit" name="logar" class="btn btn-dark">Entrar</button>
                </div>
            </form>
        </section>
    </main>
</body>

</html>