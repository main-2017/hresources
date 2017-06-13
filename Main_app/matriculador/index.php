<?php 
session_start();

if (isset($_SESSION['user'])) {
	if ($_SESSION['user']['Rol'] == 'Administrador') {
		header('Location: ../admin/');
	}elseif($_SESSION['user']['Rol'] == 'Director'){
		header('Location: ../director/');
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
			    <li class="disabled"><a href="#">Panel</a></li>
			    <li role="separator" class="divider"></li>
			    <li><a href="../salir.php">Cerrar sesión</a></li>
			  </ul>
			</div>
		</div>
	</nav>
<!-- Fin de Header -->
<!-- Barra de pestañas -->
<ul class="nav nav-tabs" id="pestañas">
	<li class="active"><a id="btn-resumen" href="#">Resumen</a></li>
	<li><a id="btn-empleados" href="#empleados">Empleados</a></li>
	<li><a id="btn-contratos" href="#">Contratos</a></li>
</ul>
<!-- Fin de Barra de pestañas -->
<!-- Sección Resumen -->
<section id="resumen">
	<div class="table-responsive" id="tabla-resumen">
	<!-- Tabla generada por el sistema -->
	</div>
</section>
<!-- Fin de Sección Resumen -->
<!-- Sección Empleados -->
<section id="empleados">
<ul class="nav nav-pills nav-justified" id="pills">
  <li class="active"><a href="#ingresar">Ingresar</a></li>
  <li><a href="#">Modificar</a></li>
</ul>
<div id="ingresar">
	<div class="container">
	<br>
	<h4 class="text-center text-muted">Ingreso de nuevos empleados</h4>
	<br>
		<form class="form col-lg-offset-2 col-lg-8 col-md-10 col-xs-12" role="form" id="ingresar-empleado" action="" method="POST">
			<div class="form-group">
				<input type="number" name="cc" class="form-control" id="cc-empleado" required placeholder="CC" pattern="[0-9]{8,10}">

			</div>
			<div class="form-group">
				<input type="text" name="nombre" class="form-control" id="nombre-empleado" required placeholder="Nombre" pattern="[A-Za-z ]{2,50}">
				<input type="text" name="apellido" class="form-control" id="apellido-empleado" required placeholder="Apellido" pattern="[A-Za-z ]{2,50}">
			</div>
			<div class="form-group">
				<input type="tel" name="telefono" class="form-control" id="telefono-empleado" placeholder="Teléfono" pattern="[0-9()]{4,20}">
				<input type="tel" name="celular" class="form-control" id="celular-empleado" placeholder="Celular" pattern="[0-9()]{4,20}">
			</div>
			<div class="form-group">
				<input type="text" name="domicilio" class="form-control" id="domicilio-empleado" placeholder="Domicilio" required pattern="[A-Za-z0-9 ]{2,70}">
				<input type="text" name="nacionalidad" class="form-control" id="nacionalidad-empleado" placeholder="Nacionalidad" required pattern="[A-Za-z ]{2,50}">
			</div>
			<br>
			<div class="radio">
			<h5 class="text-muted text-center">Sexo</h5>
				<div style="width: 200px;display: block;margin: auto;">
					<label><input id="masculino" type="radio" name="sexo" value="masculino" checked>Masculino</label>
					<label><input id="femenino" type="radio" name="sexo" value="femenino">Femenino</label>
				</div>
			</div>
			<br>
			<h5 class="text-muted text-center">Estado</h5>
			<select class="form-control" name="estado">
				<option value="Activo">Activo</option>
				<option value="Inactivo">Inactivo</option>
				<option value="Renuncio">Renunció</option>
				<option value="Contrato terminado">Contrato terminado</option>
				<option value="Reingreso">Reingreso</option>
			</select>
			<br>
			<hr>
			<div style="float: right;">
				<button type="reset" class="btn btn-danger">Borrar</button>
				<button type="submit" class="btn btn-success">Guardar</button>
				<button type="button" class="btn btn-primary">Guardar y cargar contrato</button>
			</div>
		</form>
	</div>
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
<!-- Fin de Sección Empleados -->
<!-- Sección Contratos -->
<section id="contratos">
	<div id="cargar">
	<div class="container">
	<br>
	<h4 class="text-center text-muted">Carga de nuevos contratos</h4>
	<br>
		<form class="form col-lg-offset-2 col-lg-8 col-md-10 col-xs-12" method="POST" role="form" id="ingresar-contrato" accept="utf-8" action="../cargar-contrato.php">
			<div class="form-group">
			<h5 class="text-center text-muted">Nº de CC</h5>
			<div id="select-contratos"></div>
			<input type="number" name="cc" list="sugest-cc" placeholder="Nº de CC" class="form-control">
			<!-- <select name="cc" class="form-control" id="select-contratos">
				<option value="1">Seleccione un Nº de CC</option> -->
			</select>
			</div>
			<div class="form-group">
			<br>
			<h5 class="text-muted text-center">Fechas inicio y finalización de contrato</h5>
			<br>
					<input type="date" name="Fecha_Inicio" class="form-control" id="Fecha_Inicio" required placeholder="Fecha de inicio del contrato. Formato 'AAAA/MM/DD'">
					
					<input type="date" name="Fecha_Fin" class="form-control" id="Fecha_Fin" required placeholder="Fecha de Finalización del contrato. Formato 'AAAA/MM/DD'">
			</div>
			<br>
			<h5 class="text-muted text-center">Tipo de contrato</h5>
			<select class="form-control" name="tipo">
				<option value="Temporal 3 meses">Temporal 3 meses</option>
				<option value="Temporal 1 año">Temporal 1 año</option>
				<option value="Indefinido">Indefinido</option>
			</select>
			
			<br>
			<h5 class="text-muted text-center">Alerta de finalización de contrato</h5>
			<select class="form-control" name="Alerta">
				<option value="2592000">30 días antes</option>
				<option value="864000">10 días antes</option>
				<option value="172800">2 días antes</option>
			</select>

			<hr>
			<div style="float: right;">
				<button type="reset" class="btn btn-danger">Borrar</button>
				<button type="submit" class="btn btn-success">Guardar</button>
			</div>
		</form>
	</div>
</div>


<!-- Ventana Modal de confirmación y error -->
<!-- Modal Exito-->
<div class="modal fade" id="exito_contrato" tabindex="-1" role="dialog" aria-labelledby="exitoContratoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #337ab7;">
        <h4 class="modal-title" id="exitoContratoModalLabel" style="color: #FFF;">Carga Exitosa</h4>
       
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
<div class="modal fade" id="error_contrato" tabindex="-1" role="dialog" aria-labelledby="errorContratoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: red;">
        <h4 class="modal-title" id="errorContratoModalLabel" style="color: #FFF;">Error de carga</h4>
       
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
<!-- Fin de Sección Contratos -->
	
	

	<?php include('../../includes_style/footer.php') ?>
	<?php include('../../includes_style/scripts-interior.php') ?>	
</body>
</html>

