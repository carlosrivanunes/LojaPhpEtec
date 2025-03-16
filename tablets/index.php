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

        <table class="table table-hover ms-1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th width="30%">Descrição</th>
                    <th>Preço</th>
                    <th>Imagem</th>
                    <th>Atualizado em</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($tablets): ?>
                    <?php foreach ($tablets as $tablet): ?>
                        <tr>
                            <td><?php echo $tablet['id']; ?></td>
                            <td><?php echo $tablet['descricao']; ?></td>
                            <td><?php echo $tablet['precou']; ?></td>
                            <td><?php echo $tablet['img']; ?></td>
                            <?php
                                $data = new DateTime(
                                    $tablet['modified'],
                                    new DateTimeZone("America/Sao_Paulo")
                                )
                            ?>
                            <td><?php echo $data -> format("d/m/Y - H:i:s") ?></td>
                            <td class="actions text-right">
                                <a href="view.php?id=<?php echo $tablet['id']; ?>" class="btn btn-sm btn-success"><i
                                        class="fa fa-eye"></i> Visualizar</a>
                                <?php if (isset($_SESSION['user'])) { ?> 
                                <a href="edit.php?id=<?php echo $tablet['id']; ?>" class="btn btn-sm btn-warning"><i
                                        class="fa fa-pencil"></i> Editar</a>
                                <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal"
                                    data-tablet="<?php echo $tablet['id']; ?>" data-type="tablet">
                                    <i class="fa fa-trash"></i> Excluir
                                </a>
                                <?php } ?>
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

        <script src="../js/DelR.js"></script>
</html>