<?php
class BuscarUsuario {
    private $userRepository;
    private $id;

    function __construct ($userRepository) {
        $this->userRepository = $userRepository;
    }

    function execute () {
        return $this->userRepository->getAll();
    }
}