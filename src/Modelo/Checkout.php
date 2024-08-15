<?php

class Checkout
{
    public function inserirCheckout(Produto $produto, int $qtd): void
    {
        $_SESSION['produto-'.$produto->getID()] =
            [
                'id' => $produto->getID(),
                'nome' => $produto->getNome(),
                'imagem' => $produto->getImagemDiretorio(),
                'descricao' => $produto->getDescricao(),
                'preco' => $produto->getPreco(),
                'qtd' => $qtd,
            ];
    }
}