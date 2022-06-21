<?php
class InserirUsuario {
    private $userRepository;
    private $userData;

    function __construct ($userRepository, $rawUserData) {
        $this->userRepository = $userRepository;
        
        $this->userData->nome = $rawUserData->nome;
        $this->userData->email = $rawUserData->email;
        $this->userData->login = $rawUserData->login;
        $this->userData->senha = $rawUserData->senha;
    }

    function execute () {
        $rows = $this->userRepository->insert($this->userData);

        return $rows;
    }
}