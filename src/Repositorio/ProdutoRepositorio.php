<?php

class ProdutoRepositorio {
    private PDO $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function todosOsProdutos(): array{
        $sql = "SELECT * FROM produtos ORDER BY id";
        $statement = $this->pdo->query($sql);
        $dadosMySql = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dados = array_map(function($dado){
            return new Produto(
                $dado['id'],
                $dado['tipo'],
                $dado['nome'],
                $dado['descricao'],
                $dado['preco'],
                $dado['imagem'],
            );
        }, $dadosMySql);

        return $dados;
    }

    public function buscarPorFiltro(string $tipo): array{
        $sql = "SELECT * FROM produtos WHERE tipo = '$tipo' ORDER BY id";
        $statement = $this->pdo->query($sql);
        $dadosMySql = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dadosObj = array_map(function($dado){
            return new Produto(
                $dado['id'],
                $dado['tipo'],
                $dado['nome'],
                $dado['descricao'],
                $dado['preco'],
                $dado['imagem'],
            );
        }, $dadosMySql);

        return $dadosObj;
    }

    public function salvar(Produto $produto){
        $sql = "INSERT INTO produtos (tipo, nome, descricao, imagem, preco) VALUES (?,?,?,?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $produto->getTipo());
        $statement->bindValue(2, $produto->getNome());
        $statement->bindValue(3, $produto->getDescricao());
        $statement->bindValue(4, $produto->getImagem());
        $statement->bindValue(5, $produto->getPreco());
        $statement->execute();

        header('location: index.php');
    }

    public function editar(Produto $produto){
        $sql = "UPDATE produtos SET tipo = ?, nome = ?, descricao = ?, imagem = ?, preco = ? WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $produto->getTipo());
        $statement->bindValue(2, $produto->getNome());
        $statement->bindValue(3, $produto->getDescricao());
        $statement->bindValue(4, $produto->getImagem());
        $statement->bindValue(5, $produto->getPreco());
        $statement->bindValue(6, $produto->getID());
        $statement->execute();

        header('location: admin.php');
    }

    public function deletar(int $id): void{
        $sql = "DELETE FROM produtos WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();
        header('location: admin.php');
    }

    public function buscarUm(int $id){
        $sql = "SELECT * FROM produtos WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();

        $dados = $statement->fetch(PDO::FETCH_ASSOC);

        return new Produto(
            $dados['id'],
            $dados['tipo'],
            $dados['nome'],
            $dados['descricao'],
            $dados['preco'],
            $dados['imagem'],
        );
    }
}