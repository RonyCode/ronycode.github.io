<?php

include __DIR__ . '/../template/header.html.php'; ?>
   <div class="container">
            <?php if (isset($_SESSION['mensagem'])): ?>
                <div class=" text-center mt-2 alert alert-<?= $_SESSION[
                    'tipo_mensagem'
                ] ?>">
                    <?= $_SESSION['mensagem'] ?>
                </div>
                <?php
                unset($_SESSION['mensagem']);
                unset($_SESSION['tipo_mensagem']);
                endif; ?>
        </div>
    <div class="container-login">
        <div>
            <?php if (isset($_SESSION['senha_confere'])): ?>
                <div class=" text-center mt-2 alert alert-danger">
                   A senha digitada não confere com a anterior
                </div>
                <?php unset($_SESSION['senha_confere']);endif; ?>
        </div>

        <form action="/nova-senha" method="post">
            <div class="form-group">
                <label for="senha">Digite nova senha:</label>
                <input type="password" name="senha" id="senha"
                       class="form-control"
                       required>
                <label for="senhaConfere">confirme nova senha:</label>
                <input type="password" name="senha_confere" id="senha"
                       class="form-control"
                       required>
                <div align="left">
                    <button class="btn btn-primary  right mt-2">Enviar
                    </button>

                </div>
            </div>
        </form>

    </div>

<?php include __DIR__ . '/../template/footer.html.php'; ?>
