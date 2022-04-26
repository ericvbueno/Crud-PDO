<?php
header('Content-Type: application/json');
    class Pessoa {
    private $pdo;
    //conexão com o banco;
    public function __construct($dbname, $host, $user, $senha) {
        try {
            $this->pdo = new PDO("mysql:dbname=$dbname; host=$host", "$user", "$senha");
        } catch (PDOException $e) {
            echo "Erro: {$e->getMessage()}";
            exit();
        }
    }

    public function buscarRegistros() {
        $res = array();
        $sql = "SELECT * FROM usuario ORDER BY id DESC";
        $cmd = $this->pdo->query($sql);

        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function cadastrarPessoa($nome, $email, $login, $senha) {
        //Verifica se já existe esse cadastro
        $sql = "SELECT id FROM usuario WHERE email = ? ";
        $cmd = $this->pdo->prepare($sql);
        $cmd->execute([$email]);

        if($cmd->rowCount() > 0) {
            $response = 'Email já cadastrado';
            return $response;
        }
        
        $senha_segura = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuario (nome, email, usuario_login, senha) values (?, ?, ?, ?)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->execute([$nome, $email, $login, $senha_segura]);
        $response = 'Email cadastrado com sucesso';
        return $response;
    }

    public function excluirPessoa($id) {
        $sql = "DELETE FROM usuario WHERE id = ?";
        $cmd = $this->pdo->prepare($sql);
        $cmd->execute([$id]);
        return true;
    }

    public function buscarUsuario($id) {
        $res = array();
        $sql = "SELECT * FROM usuario WHERE id = ?";
        $cmd = $this->pdo->prepare($sql);
        $cmd->execute([$id]);
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function editarPessoa($id, $nome, $email, $login, $senha) {
        $sql = "UPDATE usuario SET nome = ? SET email = ? SET usuario_login = ? SET  senha = ? WHERE id = ?";
        $cmd = $this->pdo->prepare($sql);
        $cmd->execute([$id, $nome, $email, $login, $senha]);
    }
};


$action = addslashes($_POST["action"]);

$p = new Pessoa("crud", "localhost", "root", "");

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
        
                if(!empty($nome) && !empty($email) && !empty($login) && !empty($senha)) {
                   $response = $p->cadastrarPessoa($nome, $email, $login, $senha);
                } else {
                    $response = 'Preencha todos os campos';
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
}
?>