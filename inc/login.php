<?php
include("../config.php");
include(HEADER_TEMPLATE);
?>
<section class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 shadow-lg" style="width: 100%; max-width: 400px;">
        <h3 class="text-center mb-4">Log in</h3>
        <form action="valida.php" method="post" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="log" class="form-label">Nome de Usuário</label>
                <input id="log" name="login" type="text" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="pass" class="form-label">Senha</label>
                <input id="pass" name="senha" type="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Logar</button>
        </form>
    </div>
</section>
<?php include(FOOTER_TEMPLATE); ?>
