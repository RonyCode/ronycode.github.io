<!doctype html >
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http - equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
    <title><?= $tittleDoc; ?></title>
</head>
<body>
<nav class="navbar navbar-light bg-light ">
    <form class="form-inline">
        <a href="/home" class="btn btn-outline-success ml-5 mr-2 " type="button">
            Home</a>
        <a href="/listar-alunos" class="btn  btn-outline-secondary  mr-2" type="button"> Alunos</a>
        <a href="/login" class="btn  btn-outline-secondary  mr-2" type="button"> Entrar</a>
    </form>
</nav>
<div class="jumbotron bg-primary text-light">
    <div class="container">
        <h1 class="titulo"><?= $tittle; ?></h1>
    </div>
</div>


