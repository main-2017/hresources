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
	<li class="active"><a id="btn-resumen" href="#resumen" data-toggle="tab">Resumen</a></li>
	<li><a id="btn-empleados" href="#empleados" data-toggle="tab">Empleados</a></li>
	<li><a id="btn-contratos" href="#contratos" data-toggle="tab">Contratos</a></li>
</ul>
<!-- Fin de Barra de pestañas -->
<div class="tab-content">
<!-- Sección Resumen -->
	<section id="resumen" class="tab-pane fade in active">
		<div class="container">
		<br>
		<h4 class="text-center text-muted">Contratos próximos a vencer</h4>
		<br>
			<div class="table-responsive" id="tabla-resumen">
			<!-- Tabla generada por el sistema -->
			</div>
		</div>
	</section>
	<!-- Fin de Sección Resumen -->
	<!-- Sección Empleados -->
	<section id="empleados" class="tab-pane fade">
		<ul class="nav nav-tabs nav-justified">
		  <li class="active"><a href="#modificar" data-toggle="tab"></a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane fade in active" id="modificar">
				<div class="container">
					<br>
					<h4 class="text-center text-muted">Modificar datos de empleados</h4>
					<br>
					<form  method="post" accept-charset="utf-8" id="busqueda-empleado">
							<input class="form-control" type="text" name="search" id="search" pattern="[A-Za-z0-9]{1-50}" placeholder="Buscar empleado...">	
							<br>
							<br>
							<div id="tabla-empleado">
								<!-- Tabla generada de manera dinámica -->
							</div>
					</form>
				
				</div>
				
			</div>
			
		</div>
		
	</section>
	<!-- Fin de Sección Empleados -->
	<!-- Sección Contratos -->
	<section id="contratos" class="tab-pane fade">
		<ul class="nav nav-tabs nav-justified">
		  <li class="active"><a href="#modificar-contrato" data-toggle="tab"></a></li>
		</ul>
		<div class="tab-content">
			<!-- Sección de Modificación y eliminación de contratos -->
			<div id="modificar-contrato" class="tab-pane fade in active">
				<div class="container">
					<br>
					<h4 class="text-center text-muted">Buscar contratos cargados</h4>
					<br>
					<form  method="post" accept-charset="utf-8" id="busqueda-contrado-md">
							<input class="form-control" type="text" name="searchContract" id="searchContract" pattern="[A-Za-z0-9]{1-50}" placeholder="Buscar contrato...">	
							<br>
							<br>
							<div id="tabla-contrato">
								<!-- Tabla generada de manera dinámica -->
							</div>
					</form>
					
			<!-- Fin de sección de Modificación y eliminación de contratos -->
		</div>
	</section>
<!-- Fin de Sección Contratos -->
</div>
	<?php include('../../includes_style/footer.php') ?>
	<?php include('../../includes_style/scripts-interior.php') ?>
</body>
</html>
