<?php
    include('functions.php');
    edit();
?>

<?php include(HEADER_TEMPLATE); ?>

<h2 class="ms-3 mt-3">Atualizar Roupa</h2>

<form action="edit.php?id=<?php echo isset($cloth['id']) ? $cloth['id'] : ''; ?>" method="post" enctype="multipart/form-data" class="ms-3 me-3">
    <hr />
    <div class="row">
        <div class="form-group col-md-7">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" name="clothes[descricao]" value="<?php echo isset($cloth['descricao']) ? $cloth['descricao'] : ''; ?>" required>
        </div>

        <div class="form-group col-md-3">
            <label for="preco">Preço</label>
            <input type="number" class="form-control" name="clothes[precou]" step="0.01" value="<?php echo isset($cloth['precou']) ? $cloth['precou'] : ''; ?>" required>
        </div>

        <div class="form-group col-md-2">
            <label for="tamanho">Tamanho</label>
            <input type="text" class="form-control" name="clothes[tamanho]" value="<?php echo isset($cloth['tamanho']) ? $cloth['tamanho'] : ''; ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-5">
            <label for="quantidade">Quantidade em Estoque</label>
            <input type="number" class="form-control" name="clothes[quantidade]" value="<?php echo isset($cloth['quantidade']) ? $cloth['quantidade'] : ''; ?>" required>
        </div>

        <div class="form-group col-md-3">
            <label for="imagem">Imagem</label>
            <input type="file" class="form-control" name="img">
            <input type="hidden" name="clothes[img_atual]" value="<?php echo isset($cloth['img']) ? $cloth['img'] : ''; ?>">
        </div>

        <div class="form-group col-md-2">
            <label for="created">Data de Cadastro</label>
            <input type="text" class="form-control" name="cloth[created]" disabled value="<?php echo isset($cloth['created']) ? $cloth['created'] : ''; ?>">
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
