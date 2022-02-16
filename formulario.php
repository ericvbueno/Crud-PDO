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
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <title>Crud PDO</title>
</head>
<body>
    <section id="esquerda">
        <h2>Cadastrar Usuario</h2>
        <form action="">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome">
            <label for="nome">Email:</label>
            <input type="email" name="email" id="email">
            <label for="login">Login:</label>
            <input type="text" name="login" id="login">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha">
           <input type="submit" value="Salvar">
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
                            <a id='editar' href="">Editar</a>
                            <a id='excluir' href="">Excluir</a>
                        </td>
                        <?php
                        echo "</tr>";
                    }
                }
                        ?>
        </table>
    </section>
</body>
</html>
           