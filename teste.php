<?php

use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepoUsers;

session_start();

require 'vendor/autoload.php';

$pdo = ConnectionFactory::createConnection();
$repo = new PdoRepoUsers($pdo);

$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
// $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

if ($repo->login($usuario, $senha) === true) {
    echo "finalmente porraaa";
} else {
    echo 'que desgraça ainda nao consegui';
}
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
