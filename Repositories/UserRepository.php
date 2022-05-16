<?php
class UserRepository {
    private $connection;

    function __construct ($connection) {
        $this->connection = $connection;
    }

    function getAll () {
        return $this->connection->getAll("SELECT * FROM usuario ORDER BY id DESC");
    }
}