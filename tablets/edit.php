<?php
    include('functions.php');
    edit();
?>

<?php include(HEADER_TEMPLATE); ?>

<h2 class="ms-3 mt-3">Atualizar Produtos</h2>

<form action="edit.php?id=<?php echo isset($tablet['id']) ? $tablet['id'] : ''; ?>" method="post" enctype="multipart/form-data" class="ms-3 me-3">
    <hr />
    <div class="row">
        <div class="form-group col-md-7">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" name="tablets[descricao]" value="<?php echo isset($tablet['descricao']) ? $tablet['descricao'] : ''; ?>" required>
        </div>

        <div class="form-group col-md-3">
            <label for="preco">Preço</label>
            <input type="number" class="form-control" name="tablets[precou]" step="0.01" value="<?php echo isset($tablet['precou']) ? $tablet['precou'] : ''; ?>" required>
        </div>

        <div class="form-group col-md-2">
            <label for="tamanho">Em Estoque/Lojas</label>
            <input type="text" class="form-control" name="tablets[tamanho]" value="<?php echo isset($tablet['tamanho']) ? $tablet['tamanho'] : ''; ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-5">
            <label for="quantidade">Em Estoque/Armazém</label>
            <input type="number" class="form-control" name="tablets[quantidade]" value="<?php echo isset($tablet['quantidade']) ? $tablet['quantidade'] : ''; ?>" required>
        </div>

        <div class="form-group col-md-3">
            <label for="imagem">Imagem</label>
            <input type="file" class="form-control" name="img">
            <input type="hidden" name="tablets[img_atual]" value="<?php echo isset($tablet['img']) ? $tablet['img'] : ''; ?>">
        </div>

        <div class="form-group col-md-2">
            <label for="created">Data de Cadastro</label>
            <input type="text" class="form-control" name="tablets[created]" disabled value="<?php echo isset($tablet['created']) ? FormataData2($tablet['created'], "Y-m-d"): ''; ?>">
        </div>
    </div>
    

    <div id="actions" class="row mt-3">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="index.php" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>
