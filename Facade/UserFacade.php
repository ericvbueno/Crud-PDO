<?php
require("../Connection/ConnectionPdo.php");
require('../Model/UserRepository.php');
require('../Controller/BuscarUsuario.php');
require('../Controller/InserirUsuario.php');

function userRepositoryFactory () {
    $connection = new ConnectionPdo("root", "", "localhost", "crud");
    return new UserRepository($connection);
}

$action = addslashes($_POST["action"]);

switch($action) {
    case 'buscarRegistros':
        $userRepository = userRepositoryFactory();
        $buscarUsuario  = new BuscarUsuario($userRepository);
        $dados = $buscarUsuario->execute();
        echo json_encode($dados);
        break;

    case 'cadastrarUsuario':
        if(isset($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $login = addslashes($_POST['login']);
            $senha = addslashes($_POST['senha']);
            $response = 'Preencha todos os campos';

            $myObj = new stdClass();
            $myObj->nome = $nome;
            $myObj->email = $email;
            $myObj->login = $login;
            $myObj->senha = $senha;
            
            $rawUserData = json_encode($myObj);

            if(!empty($nome) && !empty($email) && !empty($login) && !empty($senha)) {
                $userRepository = userRepositoryFactory();
                $cadastrarPessoa = new InserirUsuario($userRepository, $rawUserData);
                $response = $cadastrarPessoa->execute();
            }
        }
        echo json_encode($response);
        break;
    }