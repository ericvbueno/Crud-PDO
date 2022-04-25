<?php 
    require_once '../class-pessoa.php';
    $p = new Pessoa("crud", "localhost", "root", "");

    if(isset($_POST['id_usuario'])) {
        $id_usuario = addslashes($_POST['id_usuario']);
        $res = $p->buscarUsuario($id_usuario);
        return $res;
    }
    header('Location: /Projeto PDO/index.php');
?>