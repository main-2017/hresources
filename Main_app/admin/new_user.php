<?php 
session_start();
if (isset($_SESSION['user'])) {
	if ($_SESSION['user']['Rol'] == 'Director') {
		header('Location: ../director/');
	}elseif($_SESSION['user']['Rol'] == 'Matriculador'){
		header('Location: ../matriculador/');
	}
}
?>
<!DOCTYPE html>
<html>
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
			    <li><a href="index.php">Panel</a></li>
			    <li><a href="gestion.php">Alertas</a></li>
			    <li class="disabled"><a href="new_user.php">Nuevo usuario</a></li>
			    <li role="separator" class="divider"></li>
			    <li><a href="../salir.php">Cerrar sesión</a></li>
			  </ul>
			</div>
		</div>
	</nav>
<!-- Fin de Header -->
<!-- Carga de nuevos usuarios -->
<section id="ingresar-user">
<ul class="nav nav-pills nav-justified" id="pills">
  <li class="active"><a href="#ingresar">Ingresar</a></li>
  <li><a href="#">Modificar</a></li>
  <li><a href="#">Eliminar</a></li>
</ul>
<div id="ingresar">
	<div class="container">
	<br>
	<h4 class="text-center text-muted">Ingreso de nuevos usuarios</h4>
	<br>
		<form class="form col-lg-offset-2 col-lg-8 col-md-10 col-xs-12" method="POST" role="form" id="ingresar-user" accept="utf-8">
			<div class="form-group">
				<input type="number" name="cc" class="form-control" id="cc-admin" required placeholder="CC" pattern="[0-9]{8,10}">
			</div>
			<div class="form-group">
				<input type="text" name="nombre" class="form-control" id="nombre-admin" required placeholder="Nombre" pattern="[A-Za-z ]{2,50}">
				<input type="text" name="apellido" class="form-control" id="apellido-admin" required placeholder="Apellido" autocomplete="off" pattern="[A-Za-z ]{2,50}">
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control" id="password-admin" placeholder="Contraseña" autocomplete="off" pattern="[A-Za-z0-9.]{4,20}">
				<input type="password" name="password-repeat" class="form-control" id="password-repeat" placeholder="Repetir contraseña" autocomplete="off" pattern="[A-Za-z0-9.]{4,20}">
				<input type="email" name="email" class="form-control" id="email-admin" placeholder="E-mail" autocomplete="off" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}">
			</div>
			<br>			
			<h5 class="text-muted text-center">Tipo de usuario</h5>
			<select class="form-control" name="rol">
				<option value="Administrador">Administrador</option>
				<option value="Director">Director</option>
				<option value="Matriculador">Matriculador</option>
			</select>
			<hr>
			<div style="float: right;">
				<button type="reset" class="btn btn-danger">Borrar</button>
				<button id="enviar" type="submit" class="btn btn-success">Guardar</button>
			</div>
		</form>
	</div>
	<!-- Ventana Modal de confirmación y error -->
<!-- Modal Exito-->
<div class="modal fade" id="exito_admin" tabindex="-1" role="dialog" aria-labelledby="exitoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #337ab7;">
        <h4 class="modal-title" id="exitoModalLabel" style="color: #FFF;">Carga Exitosa</h4>
       
      </div>
      <div class="modal-body">
        <p>Datos cargados correctamente</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Fin de ventana Modal Exito-->

<!-- Modal Error -->
<div class="modal fade" id="error_admin" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: red;">
        <h4 class="modal-title" id="errorModalLabel" style="color: #FFF;">Error de carga</h4>
       
      </div>
      <div class="modal-body">
        <p>Ocurrió un error durante la carga de datos. Reinténtelo</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal Error -->
</div>

</section>
<!-- Fin de Sección admin -->
	<?php include('../../includes_style/footer.php') ?>
	<?php include('../../includes_style/scripts-interior.php') ?>
</body>
</html>