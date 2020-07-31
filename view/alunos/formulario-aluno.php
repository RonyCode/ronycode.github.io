<?php

include __DIR__ . '/../template/header.html.php'; ?>
    <div class="container">
        <form action="/salvar-aluno<?= isset($aluno) ? '?id=' . $aluno->getId() : ''; ?>" method="post">
            <div class="form-group">
                <label for="name">Nome do Aluno:</label>
                <input type="text"
                       name="name"
                       id="name"
                       class="form-control"
                       value="<?= isset($aluno) ? $aluno->getName() : ''; ?>" required>
                <label for="address">Endereço:</label>
                <input type="text"
                       name="address"
                       id="address"
                       class="form-control"
                       value="<?= isset($aluno) ? $aluno->getAddress() : ''; ?>" required>

                <div align="center">
                    <button class="btn btn-primary btn-block right mt-2">Salvar
                    </button>
                </div>
            </div>
        </form>
    </div>
<?php
include __DIR__ . '/../template/footer.html.php'; ?>