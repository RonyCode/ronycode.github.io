<?php

include __DIR__ . '/../template/header.html.php'; ?>


<div class="container">
  <form action="/login-realizado" method="post">
    <div class="form-group">
      <label for="name">Digite seu e-mail:</label>
      <input type="email" name="email" id="email" class="form-control" required>

      <label for="senha">Digite sua senha:</label>
      <input type="password"
             name="senha"
             id="senha"
             class="form-control" required>

      <div align="left">
        <button class="btn btn-primary right mt-2">Entrar
        </button>
        <a href="/formulario-cadastrar-login" class="btn btn-primary  right mt-2">Cadastrar
        </a>
      </div>
    </div>
  </form>
</div>

<?php
include __DIR__ . '/../template/footer.html.php'; ?>
