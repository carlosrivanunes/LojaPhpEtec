<?php
include("functions.php");
index();
include(HEADER_TEMPLATE);
?>

<?php 
    if (!isset($_SESSION['user'])) {
        header("Location: " . BASEURL . "/index.php");
    }
?>

<header class="mt-2">
    <div class="grid text-start">
        <div class="col-sm-6">
        </div>
        <div class="col-sm-6">
            <?php if (isset($_SESSION['user'])) : ?>
                <a class="btn btn-outline-dark btn-lg mt-3 btn-color me-4" href="add.php"><i class="fa fa-plus"></i> Novo Usuário</a>
            <?php endif; ?>
            <a class="btn btn-outline-dark btn-lg mt-3 btn-color" href="index.php"><i class="fa-solid fa-refresh"></i> Atualizar</a>
        </div>
    </div>
</header>
<hr>
<div class="table-responsive">
    <table class="table table-hover mt-5 mb-5">
        <thead>
            <tr>
                <th>
                    <h6>ID</h6>
                </th>
                <th>
                    <h6>Nome</h6>
                </th>
                <th>
                    <h6>Usuário</h6>
                </th>
                <th>
                    <h6>Foto</h6>
                </th>
                <th>
                    <h6>Opções</h6>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if ($usuarios) : ?>
                <?php foreach ($usuarios as $usuario) : ?>
                    <tr class="align-middle">
                        <td><?php echo $usuario['id']; ?></td>
                        <td><?php echo $usuario['nome']; ?></td>
                        <td><?php echo $usuario['user']; ?></td>
                        <td><?php
                            if (!empty($usuario['foto'])) {
                                echo "<img src=\"fotos/" . $usuario['foto'] . "\" class=shadow p-1 mb-1 bg-body rouded\" width=\"100px\">";
                            } else {
                                echo "<img src=\"fotos/semimagem.jpg\" class=shadow p-1 mb-1 bg-body rouded\" width=\"100px\">";
                            }
                            ?>
                        </td>
                        <td>
                            <a href="view.php?id=<?php echo $usuario['id']; ?>" class="btn btn-outline-dark btn-lg mt-3 btn-color me-3"><i class="fa fa-eye"></i> </a>
                            <?php if (isset($_SESSION['user'])) : ?>
                                <a href="edit.php?id=<?php echo $usuario['id']; ?>" class="btn btn-outline-dark btn-lg mt-3 btn-color me-3"><i class="fa fa-pencil"></i> </a>
                                <!-- Corrigindo o atributo 'data-usuario-id' -->
                                <a href="#" class="btn btn-outline-dark btn-lg mt-3 btn-color" data-bs-toggle="modal" data-bs-target="#delete-modal" data-id="<?php echo $usuario['id']; ?>" data-type="usuário">
                                    <i class="fa fa-trash"></i>
                                </a>
                            <?php endif; ?>
                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7" class="text-center">Nenhum registro encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php include("modal.php"); ?>
<?php include(FOOTER_TEMPLATE); ?>