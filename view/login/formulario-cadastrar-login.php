<?php

include __DIR__ . '/../template/header.html.php'; ?>
<div class="container-login">
    <div>
        <?php
        if (isset($_SESSION['mensagem'])): ?>
            <div class=" text-center mt-2 alert alert-<?= $_SESSION['tipo_mensagem'] ?>">
                <?= $_SESSION['mensagem'] ?>
            </div>
            <?php
            unset($_SESSION['mensagem']);
            unset($_SESSION['tipo_mensagem']);
        endif; ?>
    </div>

    <form action="/login-salvar" method="post">
        <div class="form-group">

            <label for="email">Digite sua email:</label>
            <input type="email" name="email" id="email" class="form-control"
                   required>

            <label for="email-comparado">Digite novamente seu
                e-mail:</label>
            <input type="email" name="email-comparado" id="email-comparado"
                   class="form-control"
                   required>

            <label for="senha">Digite sua senha:</label>
            <input type="password" name="senha" id="senha"
                   class="form-control"
                   required>

            <div align="left">
                <button class="btn btn-primary  right mt-2">Cadastrar
                </button>
                <a href="/login" class="btn btn-primary  right mt-2">Voltar
                </a>

            </div>
        </div>
    </form>
</div>

<?php
include __DIR__ . '/../template/footer.html.php'; ?>
