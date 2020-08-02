<?php

include __DIR__ . '/../template/header.html.php'; ?>
<?php if (isset($_SESSION['mensagem'])): ?>
    <div class=" text-center mt-2 alert alert-<?= $_SESSION['tipo_mensagem'] ?>">
        <?= $_SESSION['mensagem'] ?>
    </div>
    <?php
    unset($_SESSION['mensagem']);
    unset($_SESSION['tipo_mensagem']);
endif; ?>
    <div class="container">
        <p class="">
            Este ambiente será para inserir aluno no DB
        </p>

        <table class="table table-light">

            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Endereço</th>
            </tr>
            </thead>

            <?php
            foreach ($alunos

            as $aluno) : ?>
            <tbody>
            <tr>
                <th scope="row"><?= $aluno->getId(); ?></th>
                <td><?= $aluno->getName(); ?></td>
                <td><?= $aluno->getAddress(); ?>
                    <a href="/remover-aluno?id=<?= $aluno->getId(); ?>"
                       class="btn btn-primary right float-right text-light">Excluir</a>
                    <a href="/editar-aluno?id=<?= $aluno->getId(); ?>"
                       class="btn btn-info right float-right mr-1">Editar</a>
                </td>
                <?php
                endforeach; ?>
            </tr>
            </tbody>
        </table>

        <div class="col-lg-12" style="text-align: right;">
            <a href="/novo-aluno"
               class="btn btn-primary right">Adicionar</a>
        </div>
    </div>


<?php
unset($_SESSION['mensagem']);
unset($_SESSION['Tipo_mensagem']);
include __DIR__ . '/../template/footer.html.php'; ?>