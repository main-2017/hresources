<!-- Login -->
<!-- Comprobación de sesión iniciada -->

<?php 
session_start();

if (isset($_SESSION['user'])) {
	if ($_SESSION['user']['Rol'] == 'Administrador') {
		header('Location: Main_app/admin/');
	}elseif ($_SESSION['user']['Rol'] == 'Director') {
		header('Location: Main_app/director/');
	}elseif ($_SESSION['user']['Rol'] == 'Matriculador') {
		header('Location: Main_app/matriculador');
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes_style/cabeceras.php") ?>
	<title>hResourses | Login</title>
</head>
<body>
	<!-- Header -->
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
			      <h4 class="navbar-brand"><strong>h</strong>Resources</h4>
			</div>
		</div>
	</nav>
	<!-- Fin de Header -->
	<!-- Contenido Principal -->
	<div class="container">
                 <div id="msg-error" class="alert alert-danger text-center" style="display: none;">Los datos ingresados no son correctos</div>
	<br>
	<br>
		<section class="row">
			<div class="col-lg-offset-3 col-lg-8 col-md-offset-1 col-md-10 col-sm-12 col-xs-12">
				<form class="form col-lg-8 col-md-8 col-xs-12" rol="form" id="form-login">
				<h4 class="text-center text-muted">Inicie sesión</h4>
				<br>
					<div class="form-group">
						<input class="form-control" type="number" name="usuario" id="usuario" placeholder="Ingrese su CC" required pattern="[0-9]{8,10}">
					</div>
					<div class="form-group">
						<input class="form-control" type="password" name="password" id="password" placeholder="Ingrese su contraseña" required pattern="[A-Za-z0-9.]{8,20}">
					</div>
					<input type="submit" name="submit" id="submit" class="btn btn-primary btn-md btn-block" value="Ingresar">
				</form>
			</div>
		</section>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
	</div>
	<!-- Fin de Contenido Principal -->
	<?php include("includes_style/footer.php") ?>
	<?php include("includes_style/scripts.php") ?>
</body>
</html>