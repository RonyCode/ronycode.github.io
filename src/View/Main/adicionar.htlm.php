<?php

include __DIR__ . '/../Template/header.html.php'; ?>
    <div class="container">
        <p class="text mt-5">
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

            as $aluno): ?>
            <tbody>
            <tr>
                <th scope="row"><?= $aluno->getId(); ?></th>
                <td><?= $aluno->getName(); ?></td>
                <td><?= $aluno->getAddress(); ?></td>
                <?php
                endforeach; ?>
            </tr>
            </tbody>
        </table>

        <form action="/salvar-aluno" method="post">
            <div class="form-group">
                <label for="name">Nome do Aluno:</label>
                <input type="text" name="name" id="name" class="form-control">
                <label for="address">Endereço:</label>
                <input type="text" name="address" id="address" class="form-control">

                <div class="col-lg-12" style="text-align: right;">
                    <button class="btn btn-primary right mt-2">Adicionar</button>
                </div>
            </div>
        </form>
    </div>
    </div>

<?php
include __DIR__ . '/../Template/footer.html.php'; ?>