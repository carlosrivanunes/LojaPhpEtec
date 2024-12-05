    <hr>
    <footer class="container">
        <?php $data = new DateTime("now", new DateTimeZone("America/Sao_Paulo")) ?>
        <p>&copy;2024 à <?php echo $data->format("Y"); ?>- Alexandre e Carlos Henrique</p>
    </footer>
</body>
<script src="<?php echo BASEURL; ?>js/jquery-3.7.1.min.js"></script>
<script src="<?php echo BASEURL; ?>js/bootstrap/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASEURL; ?>js/awesome/all.min.js"></script>