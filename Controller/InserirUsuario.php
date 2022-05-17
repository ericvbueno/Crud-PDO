<?php
class InserirUsuario {
    private $userRepository;
    private $userData;

    function __construct ($userRepository, $rawUserData) {
        $this->userRepository = $userRepository;

        $this->userData->cpf = normalizeCPF($rawUserData->cpf);
        $this->userData->dataNascimento = validaData($rawUserData->dataNascimento);
        //...code
    }

    function execute () {
        $rows = $this->userRepository->insert($this->userData);

        return $rows;
    }
}