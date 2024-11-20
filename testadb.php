<?php include "config.php"; ?>
<?php include DBAPI; ?>

<?php include(HEADER_TEMPLATE); ?>

<?php 
    try {
        $db = open_database();
        echo "<h2>Banco de Dados Conectado</h2>";
    } catch (Exception $e) {
        echo "<h3> Aconteceu algum erro: <br>" . $e->getMessage() . "</h3>";
    }
?>