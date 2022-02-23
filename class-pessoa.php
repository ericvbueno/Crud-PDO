<?php
    class Pessoa {
    private $pdo;
    //conexão com o banco;
    public function __construct($dbname, $host, $user, $senha) {
        try {
            $this->pdo = new PDO("mysql:dbname=$dbname; host=$host", "$user", "$senha");
        } catch (PDOException $e) {
            echo "Erro: {$e->getMessage()}";
            exit();
        }
    }

    public function buscarUsuarios() {
        $res = array();
        $sql = "SELECT * FROM usuario ORDER BY id DESC";
        $cmd = $this->pdo->query($sql);

        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function cadastrarPessoa($nome, $email, $login, $senha) {
        //Verifica se já existe esse cadastro
        $sql = "SELECT id FROM usuario WHERE email = ? ";
        $cmd = $this->pdo->prepare($sql);
        $cmd->execute([$email]);

        if($cmd->rowCount() > 0) {
            return false;
            exit('Email já cadastrado');
        }
        
        $senha_segura = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuario (nome, email, usuario_login, senha) values (?, ?, ?, ?)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->execute([$nome, $email, $login, $senha_segura]);
        return true;
    }

    public function excluirPessoa($id) {
        $sql = "DELETE FROM usuario WHERE id = ?";
        $cmd = $this->pdo->prepare($sql);
        $cmd->execute([$id]);
    }
};
?>