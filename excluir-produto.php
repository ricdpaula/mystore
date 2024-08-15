<?php

require 'src/conexao.php';
require 'src/Modelo/Produto.php';
require 'src/Repositorio/ProdutoRepositorio.php';

$produtoRepositorio = new ProdutoRepositorio($pdo);

if(isset($_GET['id'])){
    $produtoRepositorio->deletar($_GET['id']);
}else{
    header('location: admin.php');
}
