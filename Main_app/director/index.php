<?php 
session_start();

if (isset($_SESSION['user'])) {
	if ($_SESSION['user']['Rol'] == 'Administrador') {
		header('Location: ../admin/');
	}elseif($_SESSION['user']['Rol'] == 'Matriculador'){
		header('Location: ../matriculador/');
	}
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include('../../includes_style/cabeceras-interior.php') ?>
	<title>hResources</title>
</head>
<body>
	<!-- Header -->
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
			      <h4 class="navbar-brand"><strong>h</strong>Resources</h4>
			</div>
			<br>
			<div class="btn-group" style="float: right; margin-right: 30px;">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			   <?php echo $_SESSION['user']['Nombre'] ?> <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
			    <li><a href="gestion.php">Alertas</a></li>
			    <li role="separator" class="divider"></li>
			    <li><a href="../salir.php">Cerrar sesión</a></li>
			  </ul>
			</div>
		</div>
	</nav>
<!-- Fin de Header -->	
<section id="select">
		

</section>

	<?php include('../../includes_style/footer.php') ?>
	<?php include('../../includes_style/scripts-interior.php') ?>
</body>
</html>
