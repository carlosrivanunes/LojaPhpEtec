<?php
    include('functions.php');
    add();
?>

<?php include(HEADER_TEMPLATE); ?>

<h2 class="mt-3 ms-3">Novo Cliente</h2>

<form action="add.php" method="post" class="ms-3 me-3">
    
    <hr/>
    <div class="row">
        <div class="form-group col-md-7">
            <label for="name">Nome / Razão Social</label>
            <input type="text" class="form-control" name="customer['name']" required>
        </div>

        <div class="form-group col-md-3">
            <label for="campo2">CPF</label>
            <input type="text" class="form-control" name="customer['cpf_cnpj']" minlength="10" maxlength="10">
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">Data de Nascimento</label>
            <input type="date" class="form-control" name="customer['birthdate']" required>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-5">
            <label for="campo1">Endereço</label>
            <input type="text" class="form-control" name="customer['address']" >
        </div>

        <div class="form-group col-md-3">
            <label for="campo2">Bairro</label>
            <input type="text" class="form-control" name="customer['hood']">
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">CEP</label>
            <input type="text" id="cep" class="form-control" name="customer['zip_code']" minlength="8" maxlength="8">
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">Data de Cadastro</label>
            <input type="text" class="form-control" name="customer['created']" disabled>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-3">
            <label for="campo1">Município</label>
            <input type="text" class="form-control" name="customer['city']">
        </div>

        <div class="form-group col-md-2">
            <label for="campo2">Telefone</label>
            <input type="text" class="form-control" name="customer['phone']" minlength="11" maxlength="11">
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">Celular</label>
            <input type="text" class="form-control" name="customer['mobile']" minlength="11" maxlength="11">
        </div>

        <div class="form-group col-md-1">
            <label for="campo3">UF</label>
            <input type="text" class="form-control" name="customer['state']">
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">Inscrição Estadual</label>
            <input type="text" class="form-control" name="customer['ie']" required>
        </div>

    </div>

    <div id="actions" class="row mt-2">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="index.php" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>