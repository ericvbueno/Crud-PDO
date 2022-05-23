<?php
require('./Connection/ConnectionPdo.php');
require('./Model/UserRepository.php');
require('./Controller/BuscarUsuario.php');

function userRepositoryFactory () {
    $connection = new ConnectionPdo("root", "", "localhost", "crud");
    return new UserRepository($connection);
}

function buscarRegistros () {
    $userRepository = userRepositoryFactory();
    $buscarUsuario  = new BuscarUsuario($userRepository);

    return $buscarUsuario->execute();
}

// function inserirUsuario ($dadosUsuario) {
//     $userRepository = userRepositoryFactory();
//     $inserirUsuario = new InserirUsuario($userRepository, $dadosUsuario);

//     return $inserirUsuario->execute();
// }