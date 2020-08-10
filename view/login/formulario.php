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
            unset($_SESSION['mensagem'], $_SESSION['tipo_mensagem']);endif; ?>
    </div>

    <form action="/login-realizado" method="post">
        <div class="form-group">
            <label for="email">Digite e-mail:</label>
            <input type="text" name="email" id="email"
                   class="form-control" required>

            <label for="senha">Digite sua senha:</label>
            <input type="password" name="senha" id="senha"
                   class="form-control" required>

            <div align="left">
                <button class="btn btn-primary right mt-2">Entrar
                </button>
                <a href="/login-cadastrar"
                   class="btn btn-primary  right mt-2">Cadastrar
                </a>
                <a class="recupera-senha" href="/recupera-senha-form">Esqueci
                    minha senha</a>
            </div>
        </div>
    </form>
</div>

<?php
include __DIR__ . '/../template/footer.html.php'; ?>
