<?php
    include('functions.php');
    index();
?>

<?php include(HEADER_TEMPLATE); ?>

        <?php if (!empty($_SESSION['message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $_SESSION['message']; ?>
            </div>
            <?php //clear_messages(); ?>
            <?php endif; ?>

        <hr>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th width="30%">Nome</th>
                    <th>CPF/CNPJ</th>
                    <th>Telefone</th>
                    <th>Atualizado em</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($customers): ?>
                    <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td><?php echo $customer['id']; ?></td>
                            <td><?php echo $customer['name']; ?></td>
                            <td><?php echo cpf($customer['cpf_cnpj']);?></td>
                            <td><?php echo telefone($customer['phone']); ?></td>
                            <?php
                                $data = new DateTime(
                                    $customer['modified'],
                                    new DateTimeZone("America/Sao_Paulo")
                                )
                            ?>
                            <td><?php echo $data -> format("d/m/Y - H:i:s") ?></td>
                            <td class="actions text-right">
                                <a href="view.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-success"><i
                                        class="fa fa-eye"></i> Visualizar</a>
                                <a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-warning"><i
                                        class="fa fa-pencil"></i> Editar</a>
                                <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal"
                                    data-customer="<?php echo $customer['id']; ?>" data-type="cliente">
                                    <i class="fa fa-trash"></i> Excluir
                                </>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Nenhum registro encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php include('modal.php'); ?>

        <?php include(FOOTER_TEMPLATE); ?>
        <script src="../js/DelC.js"></script>
</html>