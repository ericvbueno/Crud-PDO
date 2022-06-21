<?php
class UserRepository {
    private $connection;

    function __construct ($connection) {
        $this->connection = $connection;
    }

    function getAll () {
        return $this->connection->getAll("SELECT * FROM usuario ORDER BY id DESC");
    }

    function insert ($userData) {
        $user = $this->connection->getByField("SELECT * FROM usuario WHERE email = ?", $userData->email);

        if ($user) {
            die("User already exists. Check By id: ".$user["id"]);
        }

        $nome = $userData->nome;
        $email = $userData->email;
        $login = $userData->login;
        $senha = $userData->senha;
        $senha_segura = password_hash($senha, PASSWORD_DEFAULT);

        $insert = $this->connection->insert("INSERT INTO usuario (nome, email, usuario_login, senha) VALUES ($nome, $email, $login, $senha_segura)");

        return $insert->rows;
    }
}