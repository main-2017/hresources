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
	<?php include('../../includes_style/cabeceras-interior.php'); ?>
	<title>hResourse</title>
</head>
<body>
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
			    <li class="disabled"><a href="gestion.php">Alertas</a></li>
			    <li><a href="new_user.php">Nuevo usuario</a></li>
			    <li role="separator" class="divider"></li>
			    <li><a href="../salir.php">Cerrar sesión</a></li>
			  </ul>
			</div>
		</div>
	</nav>
<!-- Sección principal -->
<section id="gestion-content">
	<div class="container">
		<div class="table-responsive" id="tabla-gestion">
		<!-- Tabla generada por el sistema -->
		</div>
		<form id="form-check" method="POST" action="../save-admin.php">
			
		<button type="submit" class="btn btn-primary" style="float: right;">Guardar</button>
		</form>
	</div>
	<!-- Ventana Modal de confirmación y error -->
<!-- Modal Exito-->
<div class="modal fade" id="exito" tabindex="-1" role="dialog" aria-labelledby="exitoModalLabel" aria-hidden="true">
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
<div class="modal fade" id="error" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
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
</section>
<!-- Fin de Sección Principal -->
	<?php include('../../includes_style/footer.php') ?>
	<?php include('../../includes_style/scripts-interior.php') ?>
</body>
</html>