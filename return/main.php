<?php
require('./Facade/UserFacade.php');

$action = addslashes($_POST["action"]);

switch($action) {
    case 'buscarRegistros':
        $dados = $p->buscarRegistros();
        echo json_encode($dados);
        break;
        
    case 'cadastrarUsuario':
        if(isset($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $login = addslashes($_POST['login']);
            $senha = addslashes($_POST['senha']);
            $response = 'Preencha todos os campos';

            if(!empty($nome) && !empty($email) && !empty($login) && !empty($senha)) {
                $response = $p->cadastrarPessoa($nome, $email, $login, $senha);
            }
        }
        echo json_encode($response);
        break;

    case 'excluirUsuario':
        $id_user = addslashes($_POST["id"]);
        $exclusao = $p->excluirPessoa($id_user);
        echo json_encode($exclusao);
        break;

    case 'buscarDadosUsuario':
        if(isset($_POST['id_usuario'])) {
            $id_usuario = addslashes($_POST['id_usuario']);
            $res = $p->buscarUsuario($id_usuario);
            echo json_encode($res);
            break;
        }

    case 'editarUsuario':
        if(isset($_POST['id_usuario'])) {
            $id_usuario = addslashes($_POST['id_usuario']);
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $login = addslashes($_POST['login']);
            $response = 'Preencha todos os campos';

            if(!empty($nome) && !empty($email) && !empty($login)) {
                $id = '';
                $response = $p->validarCadastro($email, $id);

                if(!$response) {
                    $response = $p->editarPessoa($id_usuario, $nome, $email, $login);
                } else {
                    $id = $id_usuario;
                    $response = $p->validarCadastro($email, $id);
                    if($response) {
                        $response = $p->editarPessoa($id_usuario, $nome, $email, $login);
                    }
                }
            }
        }
        echo json_encode($response);
        break;
}
?>


