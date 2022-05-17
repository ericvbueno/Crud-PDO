<?php
class UserRepository {
    private $connection;

    function __construct ($connection) {
        $this->connection = $connection;
    }

    function getAll () {
        return $this->connection->getAll("SELECT * FROM users");
    }

    function getById ($id) {
        $user = $this->connection->getById("SELECT * FROM users WHERE id = ?", $id);

        if (!$user) {
            die("User not found");
        }
        return $user;
    }

    function insert ($userData) {
        $user = $this->connection->getByField("SELECT * FROM users WHERE email = ?", $userData->email);

        if ($user) {
            die("User already exists. Check By id: ".$user["id"]);
        }

        $insert = $this->connection->insert("INSERT INTO users () VALUES ()");

        return $insert->rows;
    }
}