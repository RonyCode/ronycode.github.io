<?php

include __DIR__ . '/../template/header.html.php'; ?>
    <div class="container">
        <?php if (isset($_SESSION['mensagem'])): ?>
            <div class=" text-center mt-2 alert alert-<?= $_SESSION['tipo_mensagem'] ?>">
                <?= $_SESSION['mensagem'] ?>
            </div>
            <?php

            unset($_SESSION['mensagem']);
            unset($_SESSION['tipo_mensagem']);
        endif; ?>
    </div>
    <div class="container-login">

        <form action="/recadastra-senha" method="post">
            <div class="form-group">
                <label for="name">Digite seu e-mail:</label>
                <input type="email" name="email" id="email"
                       class="form-control"
                       required>
                <input type="hidden" name="hash" id="hash"
                       value="<?= $hash ?>">

                <div align="left">
                    <button class="btn btn-primary  right mt-2">Enviar
                    </button>
                    <a href="/login" class="btn btn-primary  right mt-2">Voltar
                    </a>
                </div>
            </div>
        </form>

    </div>

<?php include __DIR__ . '/../template/footer.html.php'; ?>