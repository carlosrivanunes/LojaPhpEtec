<?php
    include('functions.php');
    add();
?>

<?php include(HEADER_TEMPLATE); ?>

<h2 class="mt-3 ms-3">Nova Roupa</h2>

<form action="add.php" method="post" enctype="multipart/form-data" class="ms-3 me-3">
    
    <hr/>
    <div class="row">
        <div class="form-group col-md-7">
            <label for="name"> Descrição </label>
            <input type="text" class="form-control" name="clothes['descricao']" required>
        </div>

        <div class="form-group col-md-3">
            <label for="campo2">Preço</label>
            <input type="number" class="form-control" name="clothes['precou']" step="0.01" required>
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">Tamanho</label>
            <input type="number" class="form-control" name="clothes['tamanho']" required>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-5">
            <label for="campo1">Em Estoque</label>
            <input type="number" class="form-control" name="clothes['quantidade']" >
        </div>

        <div class="form-group col-md-3">
            <label for="campo2">Imagem</label>
            <input type="file" class="form-control" name="img">
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">Data de Cadastro</label>
            <input type="text" class="form-control" name="clothes['created']" disabled>
        </div>
    </div>

    <div id="actions" class="row mt-3 mb-5">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="index.php" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>