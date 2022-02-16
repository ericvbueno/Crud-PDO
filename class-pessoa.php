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
};
?>