<?php 
    require_once '../class-pessoa.php';
    $p = new Pessoa("crud", "localhost", "root", "");

    if(isset($_POST['nome'])) {
        //para evitarmos sql injection utilizamos algumas funções para tratar os dados
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $login = addslashes($_POST['login']);
        $senha = addslashes($_POST['senha']);

        if(!empty($nome) && !empty($email) && !empty($login) && !empty($senha)) {
            $p->cadastrarPessoa($nome, $email, $login, $senha);
        } else {
            echo 'Preencha todos os campos';
        }
    }
    // header('Location: /Projeto PDO/index.php');
?>