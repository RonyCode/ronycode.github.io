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
    <link rel="stylesheet" type="text/css" href="style/style-template.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">

    <title><?= $tittleDoc ?></title>
</head>

<body>
<div class="nav-color">
    <div class="container">
        <?php if (isset($_SESSION['usuario'])): ?>
            <nav class="navbar navbar-light bg-personal">
                <form class="form-inline d-flex ">

                    <a href="/home"
                       class="btn btn-outline-success ml-5 mt-auto mr-1 "
                       type="button">
                        Home</a>
                    <a href="/listar-alunos"
                       class="btn  btn-outline-info mt-auto"
                       type="button"> Alunos</a>
                </form>
                <a href="/logout"
                   class="  btn btn-outline-danger mr-5"
                   type="button"> Sair</a>
            </nav>
        <?php endif; ?>
    </div>
    <div class="container-header">
        <div class="nav-teste container">
            <h1 class="titulo "><?= $tittle ?></h1>
        </div>
    </div>
</div><!--nav-color-->
<div class="wrapper">
