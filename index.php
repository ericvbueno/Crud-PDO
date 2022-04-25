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
    <title>Crud PDO</title>
</head>
<body>
    <section id="esquerda">
        <h2>Cadastrar Usuario</h2>
        <form>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome">
            <label for="nome">Email:</label>
            <input type="email" name="email" id="email">
            <label for="login">Login:</label>
            <input type="text" name="login" id="login">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha">
           <input type="submit" onclick="Cadastrar()" id="salvar" value="Salvar">
        </form>
    </section>
    <section id="direita">
        <table>
            <thead>
                <tr id="titulo">
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Login</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="dados">
            </tbody>
        </table>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="request/request.js"></script>
</body>
</html>
           