<?php
require('Connection.php');

class ConnectionPdo extends Connection  {

    private $user;
    private $password;
    private $host;
    private $dbName;

    function __construct ($user, $password, $host, $dbName) {
        $this->user = $user;
        $this->password = $password;
        $this->host = $host;
        $this->dbName = $dbName;
    }

    protected function start () {
        try{
            return new PDO('mysql:host='.$this->host.';dbname='.$this->dbName, $this->user, $this->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $ex){
            return 'Unable to connect';
        }
    }

    public function getAll ($query) {
        $pdo = $this->start();

        $statement = $pdo->prepare($query);
        $statement->execute();
        
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById ($query, $id) {
        $pdo = $this->start();

        $statement = $pdo->prepare($query);
        $statement->bindParam(1, $id);
        $statement->execute();
        
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getByField ($query, $field) {
        $pdo = $this->start();

        $statement = $pdo->prepare($query);
        $statement->bindParam(1, $field);
        $statement->execute();
        
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function insert ($query) {
        $pdo = $this->start();
        $statement = $pdo->prepare($query);
        $statement->execute();
        $response = 'Email cadastrado com sucesso';
        return $response;
    }

}
