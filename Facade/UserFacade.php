<?php
require('./Connection/ConnectionPdo.php');
require('./Model/UserRepository.php');
require('./Controller/BuscarUsuario.php');

function userRepositoryFactory () {
    $connection = new ConnectionPdo("root", "123", "localhost", "teste");
    return new UserRepository($connection);
}

function buscarUsuarioPorId ($id) {
    $userRepository = userRepositoryFactory();
    $buscarUsuario  = new BuscarUsuario($userRepository, $id);

    return $buscarUsuario->execute();
}

function inserirUsuario ($dadosUsuario) {
    $userRepository = userRepositoryFactory();
    $inserirUsuario = new InserirUsuario($userRepository, $dadosUsuario);

    return $inserirUsuario->execute();
}