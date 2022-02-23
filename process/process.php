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
          if ( !$p->cadastrarPessoa($nome, $email, $login, $senha)) {
              echo 'Email já cadastrado';
          }
        } else {
            echo 'Preencha todos os campos';
        }
    }

    if(isset($_GET['id'])) {
        $id_user = addslashes($_GET['id']);
        $p->excluirPessoa($id_user);
    }
    header('Location: /Projeto PDO/index.php');
?>