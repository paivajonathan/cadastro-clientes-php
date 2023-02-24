<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastre-se</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/index.css">
</head>
<body>
    <form method="post" onsubmit="return validar();">
        <div id="main">
            <h1 id="titulo">Cadastre-se!</h1>
            <div class="center">
                <input type="text" name="nome" placeholder="Nome" autocomplete="off" required>
                <input type="email" name="email" placeholder="E-mail" autocomplete="off" required>
                <input type="date" name="dataNascimento">
                <input type="text" name="endereco" placeholder="Endereço" autocomplete="off">
                <input type="password" name="senha" id="senha" placeholder="Senha" required>
                <input type="password" name="confirmarSenha" id="confirmar-senha" placeholder="Confirme sua senha" required>
    
                <div id="div-botoes">
                    <button type="reset" id="botao-limpar">Limpar</button>
                    <button type="submit" value="enviar" name="botao" id="botao-enviar">Enviar</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>

<?php 

include_once('../control/ClienteControl.php');
include_once('../model/Cliente.php');

if (isset($_POST['botao']) && $_POST['botao'] === 'enviar') {
    if (isset($_POST['nome']) &&
    isset($_POST['email']) &&
    isset($_POST['dataNascimento']) &&
    isset($_POST['endereco']) &&
    isset($_POST['senha']) &&
    isset($_POST['confirmarSenha'])) {
        if ($_POST['senha'] === $_POST['confirmarSenha']) {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $dataNascimento = empty($_POST['dataNascimento']) ? null : $_POST['dataNascimento'];
            $endereco = empty($_POST['endereco']) ? null : $_POST['endereco'];
            $senha = $_POST['senha'];
            
            $cliente = new Cliente();
            $cliente->setNome($nome);
            $cliente->setEmail($email);
            $cliente->setDataNascimento($dataNascimento);
            $cliente->setEndereco($endereco);
            $cliente->setSenha($senha);

            ClienteControl::insert($cliente);
        } else {
            echo '<script type="text/javascript">alert("As duas senhas não coincidem. Tente novamente.");</script>';
        }
    }
}

?>