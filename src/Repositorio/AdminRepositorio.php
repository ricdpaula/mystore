<?php

class AdminRepositorio
{
    private PDO $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function login(string $usuario, string $senha)
    {
        $sql = "SELECT * FROM user_admin WHERE usuario = ? AND senha = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $usuario);
        $statement->bindValue(2, $senha);
        $statement->execute();

        $admin = $statement->fetch(PDO::FETCH_ASSOC);
        
        if($admin){
            session_id('admin');
            session_start();    
            $_SESSION['logado'] = TRUE;
            $_SESSION['admin_nome'] = $admin['usuario'];
            header('location: admin.php');
        }else{
            return false;
        }
    }
}