<?php

use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepoStudents;
use App\Educar\Model\Aluno;
use App\Educar\Controller\HtmlRenderController;

require 'vendor/autoload.php';

$pdo = ConnectionFactory::createConnection();
$repoAlunos = new PdoRepoStudents($pdo);

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$namePost = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$addressPost = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);


$alunos = $repoAlunos->allStudents();


//foreach ($alunos as $aluno) :
//endforeach; ?>
<!---->
<!--    <form action="teste.php?id=63">-->
<!--        <div class="form-group">-->
<!--            <label for="name">Nome do Aluno:</label>-->
<!--            <input type="text"-->
<!--                   name="name"-->
<!--                   id="name"-->
<!--                   class="form-control"-->
<!--                   value="--><?//= $aluno->getName(); ?><!--"-->
<!--            >-->
<!--            <label for="address">Endereço:</label>-->
<!--            <input type="text"-->
<!--                   name="address"-->
<!--                   id="address"-->
<!--                   class="form - control"-->
<!--                   value="--><?//= $aluno->getAddress(); ?><!--"-->
<!--            >-->
<!---->
<!--            <div class="col - lg - 12" style="text - align: right;">-->
<!--                <button class="btn btn - primary right mt - 2">Adicionar</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </form>-->
<?php
//require_once __DIR__ . '/src/view/template/header.html.php';
//?>


