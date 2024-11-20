<?php
include("functions.php");
if (!isset($_SESSION)) session_start();
if (isset($_SESSION['user'])) {
	if ($_SESSION['user'] != "admin") {
		$_SESSION['message'] = "Você precisa ser administrador para acessar esse recurso!";
		$_SESSION['type'] = "danger";
		header("Location: " .  BASEURL . "index.php");
	}
} else {
	$_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
	$_SESSION['type'] = "danger";
	header("Location: " .  BASEURL . "index.php");
}
view($_GET['id']);
include(HEADER_TEMPLATE);
?>
<header>
	<h2>Usuário(a) "<?php echo $usuario['nome']; ?>"</h2>
	<hr>
</header>

<div class="container text-start mt-5">
	<div class="row align-items-center mb-5">
		<div class="col">
			<h6>Id:</h6>
			<p><?php echo $usuario['id']; ?></p>
			<h6>Nome:</h6>
			<p><?php echo $usuario['nome']; ?></p>
			<h6>Login:</h6>
			<p><?php echo $usuario['user']; ?></p>
		</div>
		<div class="col">
			<h6>Foto:</h6>
			<?php
			if (!empty($usuario['foto'])) {
				echo "<img src=\"fotos/" . $usuario['foto'] . "\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"300px\">";
			} else {
				echo "<img src=\"fotos/semimagem.jpg\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"300px\">";
			}
			?>
		</div>
	</div>
	<div id="actions" class="row">
		<div class="col-md-12">
			<?php if (isset($_SESSION['user'])) : ?>
				<a href="edit.php?id=<?php echo $usuario['id']; ?>" class="btn btn-outline-dark btn-lg mt-3 btn-color me-4"><i class="fa-solid fa-pencil me-2"></i>Editar</a>
			<?php endif; ?>
			<a href="index.php" class="btn btn-outline-dark btn-lg mt-3 btn-color"><i class="fa-solid fa-arrow-left"></i> Cancelar</a>
		</div>
	</div>
</div>
<?php include(FOOTER_TEMPLATE); ?>