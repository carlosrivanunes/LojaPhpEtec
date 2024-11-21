<?php
include("functions.php");
if (!isset($_SESSION)) session_start();

// Verificação de login e permissão de administrador
if (isset($_SESSION['user'])) {
    if ($_SESSION['user'] != "admin") {
        $_SESSION['message'] = "Você precisa ser administrador para acessar esse recurso!";
        $_SESSION['type'] = "danger";
        header("Location: " .  BASEURL . "index.php");
    }
} else {
    $_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
    $_SESSION['type'] = "danger";
    header("Location: " .  BASEURL . "index.php");
}

// Chama a função que carrega os dados do usuário
edit();

// Inclui o template de cabeçalho
include(HEADER_TEMPLATE);
?>

<header>
    <h2>Atualizar Informações</h2>
</header>

<form action="edit.php?id=<?php echo $usuario['id']; ?>" method="post" enctype="multipart/form-data">
    <hr>
    <div class="row mb-5 mt-5">
        <div class="form-group col-md-4">
            <label for="nome">
                <h6>Nome</h6>
            </label>
            <input type="text" class="form-control" name="usuario[nome]" value="<?php echo htmlspecialchars($usuario['nome']); ?>">
        </div>
        <div class="form-group col-md-4">
            <label for="login">
                <h6>Usuário (Login)</h6>
            </label>
            <input type="text" class="form-control" name="usuario[user]" value="<?php echo htmlspecialchars($usuario['user']); ?>">
        </div>
        <div class="form-group col-md-4">
            <label for="senha">
                <h6>Senha</h6>
            </label>
            <input type="password" class="form-control" name="usuario[password]" value="">
        </div>
    </div>

    <div class="row mb-5">
        <?php
        // Define o caminho da foto. Caso não tenha, usa 'semimagem.jpg'
        $foto = empty($usuario['foto']) ? "semimagem.jpg" : $usuario['foto'];
        ?>
        <div class="form-group col-md-4">
            <label for="campo1">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto">
        </div>

        <div class="form-group col-md-2">
            <label for="pre">Pré-Visualização</label>
            <img class="form-control shadow p-2 mb-2 bg-body rounded" id="imgPreview" src="fotos/<?php echo $foto; ?>" alt="Foto do usuário">
        </div>
    </div>

    <div id="actions" class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-outline-dark btn-lg mt-3 btn-color me-4"><i class="fa-solid fa-sd-card"></i> Salvar</button>
            <a href="index.php" class="btn btn-outline-dark btn-lg mt-3 btn-color"><i class="fa-solid fa-arrow-left"></i> Cancelar</a>
        </div>
    </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>

<script>
    $(document).ready(() => {
        // Função para pré-visualizar a imagem
        $("#foto").change(function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $("#imgPreview").attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
