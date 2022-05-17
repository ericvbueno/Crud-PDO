<?php
class BuscarUsuario {
    private $userRepository;
    private $id;

    function __construct ($userRepository, $id) {
        $this->userRepository = $userRepository;
        $this->id = addslashes($id);
    }

    function execute () {
        return $this->userRepository->getById($this->id);
    }
}