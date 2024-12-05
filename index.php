<?php include "config.php"; ?>
<?php include DBAPI; ?>

<?php include(HEADER_TEMPLATE); ?>

<main class="container mt-5">
    <?php $db = open_database(); ?>

    <h1 class="text-center mb-5">Dashboard</h1>

    <?php if ($db): ?>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">

            <?php if (isset($_SESSION['user'])) { ?>
            <!-- Novo Cliente -->
            <div class="col">
                <a href="customers/add.php" class="card text-center shadow-sm border-primary">
                    <div class="card-body">
                        <i class="fa-solid fa-user-plus fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Novo Cliente</h5>
                    </div>
                </a>
            </div>
            <?php } ?>    
            <!-- Clientes -->
            <div class="col">
                <a href="customers" class="card text-center shadow-sm border-success">
                    <div class="card-body">
                        <i class="fa fa-users fa-3x mb-3 text-success"></i>
                        <h5 class="card-title">Clientes</h5>
                    </div>
                </a>
            </div>

            <?php if (isset($_SESSION['user'])) { ?>    
            <!-- Nova Roupa -->
            <div class="col">
                <a href="clothes/add.php" class="card text-center shadow-sm border-warning">
                    <div class="card-body">
                    <i class="fa-solid fa-cart-plus fa-3x mb-3 text-warning"></i>
                        <h5 class="card-title">Novos Produtos</h5>
                    </div>
                </a>
            </div>
            <?php } ?>  
            <!-- Roupas -->
            <div class="col">
                <a href="clothes" class="card text-center shadow-sm border-danger">
                    <div class="card-body">
                    <i class="fa-solid fa-box fa-3x mb-3 text-danger"></i>
                        <h5 class="card-title">Produtos</h5>
                    </div>
                </a>
            </div>

            <!-- Usuários (somente para admin) -->
            <?php if (isset($_SESSION['user'])): ?>
                <?php if ($_SESSION['user'] == "admin"): ?>
                    <div class="col">
                        <a href="usuarios/add.php" class="card text-center shadow-sm border-info">
                            <div class="card-body">
                                <i class="fa-solid fa-user fa-3x mb-3 text-info"></i>
                                <h5 class="card-title">Novos Usuários</h5>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="usuarios" class="card text-center shadow-sm border-dark">
                            <div class="card-body">
                                <i class="fa-solid fa-users fa-3x mb-3 text-dark"></i>
                                <h5 class="card-title">Usuários</h5>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            
        </div>
    <?php else: ?>
        <div class="alert alert-danger text-center mt-4" role="alert">
            <strong>ERRO:</strong> Não foi possível conectar ao banco de dados!
        </div>
    <?php endif; ?>
</main>

<?php include(FOOTER_TEMPLATE); ?>
