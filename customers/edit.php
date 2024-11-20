<?php
    include('functions.php');
    edit();
?>

<?php include(HEADER_TEMPLATE); ?>

<h2>Atualizar Cliente</h2>
<div class="container">
<form action="edit.php?id=<?php echo $customer['id']; ?>" method="post">
    <hr />
    <div class="row">
        <div class="form-group col-md-7">
            <label for="name">Nome / Razão Social</label>
            <input type="text" class="form-control" name="customer['name']" value="<?php echo $customer['name']; ?>">
        </div>

        <div class="form-group col-md-3">
            <label for="campo2">CPF</label>
            <input type="text" class="form-control" name="customer['cpf_cnpj']"
                value="<?php echo $customer['cpf_cnpj']; ?>" minlength="10" maxlength="10">
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">Data de Nascimento</label>
            <input type="date" class="form-control" name="customer['birthdate']"
                value="<?php echo FormataData($customer['birthdate'], "d/m/Y"); ?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-5">
            <label for="campo1">Endereço</label>
            <input type="text" class="form-control" name="customer['address']"
                value="<?php echo $customer['address']; ?>">
        </div>

        <div class="form-group col-md-3">
            <label for="campo2">Bairro</label>
            <input type="text" class="form-control" name="customer['hood']" value="<?php echo $customer['hood']; ?>">
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">CEP</label>
            <input type="text" id="cep" class="form-control" name="customer['zip_code']" value="<?php echo $customer['zip_code']; ?>" maxlength="9">
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">Data de Cadastro</label>
            <input type="date" class="form-control" name="customer['created']" disabled
                value="<?php echo $customer['created']; ?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <label for="campo1">Município</label>
            <input type="text" class="form-control" name="customer['city']" value="<?php echo $customer['city']; ?>">
        </div>

        <div class="form-group col-md-2">
            <label for="campo2">Telefone</label>
            <input type="text" class="form-control" name="customer['phone']" value="<?php echo $customer['phone']; ?>" minlength="11" maxlength="11">
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">Celular</label>
            <input type="text" class="form-control" name="customer['mobile']"
                value="<?php echo $customer['mobile']; ?>" minlength="11" maxlength="11">
        </div>

        <div class="form-group col-md-1">
            <label for="campo3">UF</label>
            <input type="text" class="form-control" name="customer['state']" value="<?php echo $customer['state']; ?>">
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">Inscrição Estadual</label>
            <input type="text" class="form-control" name="customer['ie']" value="<?php echo $customer['ie']; ?>">
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">UF</label>
            <input type="text" class="form-control">
        </div>
    </div>
    <div id="actions" class="row mt-2">
        <div class="col-md-12">
            <button type="submit" class="btn btn-outline-success">Salvar</button>
            <a href="index.php" class="btn btn-outline-danger">Cancelar</a>
        </div>
    </div>
</form>
</div>
<?php include(FOOTER_TEMPLATE); ?>