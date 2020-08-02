<?php

use App\Educar\Model\Usuario;
use App\Educar\Infrastructure\Repository\PdoRepoUsers;
use App\Educar\Infrastructure\Persistence\ConnectionFactory;

session_start();

require 'vendor/autoload.php';

$pdo = ConnectionFactory::createConnection();
$repo = new PdoRepoUsers($pdo);

$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
// $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

$e = new Usuario(null, $usuario, '', $senha);
$e->setSenha(password_hash($senha, PASSWORD_ARGON2I));
$stmt = $pdo->prepare(
    'SELECT * FROM usuarios WHERE usuario = :usuario AND senha=:senha LIMIT 1'
);
$stmt->bindValue(':usuario', $e->getUsuario());
$stmt->bindValue(':senha', $e->getSenha());
$stmt->execute();
var_dump($e->getSenha());
var_dump($senha);

try {
    if ($stmt->rowCount() > 0) {
        $usuarioQuery = $stmt->fetch();
        $teste = password_verify($senha, $usuarioQuery['senha']);
        var_dump($teste);
        if ($validate === false) {
            throw new Exception();
        } else {
            echo 'Muito bom pode logar';
        }
    } else {
        echo 'erro usuario não existe';
        exit();
    }
} catch (Exception $ex) {
    echo 'Erro ao validar senha';
}

if (!$validate === true) {
    echo 'senha nao confere';
    exit();
}
echo 'senha válida pode logar';
?>


<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http - equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">

    <title><? //= $tittleDoc ?></title>
</head>

<body>

<div class="jumbotron bg-primary text-light">
    <div class="container">
        <h1 class="titulo"><? //= $tittle ?></h1>
    </div>
</div>
<div class="container">
    <form class="form-group" method="post">

        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" class="form-control">

        <label for="senha">Email</label>
        <input type="text" name="email" class="form-control">

        <label for="senha">Senha</label>
        <input type="text" name="senha" class="form-control">

        <button class="btn btn-primary mt-2">enviar</button>

    </form>
</div>
</body>
<div class="">

    <nav class="jumbotron text-center mt-5">
        <h7> © Ronycode Todos os direitos reservados</h7>
    </nav>
</div>
</html>
