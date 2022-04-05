<?php 
    require_once 'class-pessoa.php';
    $p = new Pessoa("crud", "localhost", "root", "");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <script src="request/request.js"></script>
    <title>Crud PDO</title>
</head>
<body>
    <?php 
        if(isset($_GET['id_up'])) {
            $id_update = addslashes($_GET['id_up']);
            $res = $p->buscarDados($id_update);
        }
    ?>
    <section id="esquerda">
        <h2>Cadastrar Usuario</h2>
        <form method="POST" action="process/process.php">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?php if(isset($res)){echo $res['nome'];} ?>">
            <label for="nome">Email:</label>
            <input type="email" name="email" id="email" value="<?php if(isset($res)){echo $res['email'];} ?>">
            <label for="login">Login:</label>
            <input type="text" name="login" id="login" value="<?php if(isset($res)){echo $res['usuario_login'];} ?>">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" value="<?php if(isset($res)){echo $res['senha'];} ?>">
           <input type="submit" value="Salvar" value="<?php if(isset($res)){echo 'Atualizar';}else{echo'Cadastrar';} ?>">
        </form>
    </section>
    <section id="direita">
        <table>
            <tr id="titulo">
                <th>Nome</th>
                <th>Email</th>
                <th>Login</th>
                <th></th>
            </tr>
            <?php 
                $dados = $p->buscarUsuarios();
                if(count($dados) > 0) {
                    echo "<tr>";
                    for($i=0; $i < count($dados); $i++) {
                        foreach ($dados[$i] as $key => $value) {
                            if ($key != "id" && $key != "senha" && $key != 'nivel') {
                                echo "<td>$value</td>";
                            }
                        }
            ?>
                        <td>
                            <a id='editar' href="index.php?id_up=<?php echo $dados[$i]['id'] ?>">Editar</a>
                            <a id='excluir' href="process/process.php?id=<?php echo $dados[$i]['id'] ?>">Excluir</a>
                        </td>
                        <?php
                        echo "</tr>";
                    }
                }
                        ?>
        </table>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</body>
</html>
           