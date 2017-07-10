<?php 
session_start();
if (isset($_SESSION['user'])) {
	if ($_SESSION['user']['Rol'] == 'Director') {
		header('Location: ../director/');
	}elseif($_SESSION['user']['Rol'] == 'Matriculador'){
		header('Location: ../matriculador/');
	}
}else{
	header('Location: ../../');
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
			      <h4 class="navbar-brand" id="text-logo"><strong>h</strong>Resources</h4>
			</div>
			<br>
			<div id="btn-content" class="btn-group">
				  <button id="btn-menu" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					  <?php echo $_SESSION['user']['Nombre'] ?> <span class="caret"></span>
				  </button>
			  <ul class="dropdown-menu">
			    <li><a href="index.php">Panel</a></li>
			    <li><a href="gestion.php">Alertas</a></li>
			    <li class="disabled"><a href="new_user.php">Gestión de usuarios</a></li>
			    <li role="separator" class="divider"></li>
			    <li><a href="../salir.php">Cerrar sesión</a></li>
			  </ul>
			</div>
		</div>
	</nav>
<!-- Fin de Header -->
<!-- Carga de nuevos usuarios -->
<section id="ingresar-user">
		<ul class="nav nav-tabs nav-justified">
			<li class="active"><a href="#ingresar" data-toggle="tab">Ingresar</a></li>
		  	<li><a href="#modificar" data-toggle="tab">Modificar o Eliminar</a></li>
		</ul>
	<div class="tab-content">
		<div id="ingresar" class="tab-pane fade in active">
			<div class="container">
			<br>
			<h4 class="text-center text-muted">Ingreso de nuevos usuarios</h4>
			<br>
				<form class="form col-lg-offset-2 col-lg-8 col-md-10 col-xs-12" method="POST" role="form" id="ingresar-user" accept="utf-8">
					<div class="form-group">
						<input type="number" name="cc" class="form-control" id="cc-admin" required placeholder="CC" pattern="[0-9]{8,10}">
					</div>
					<div class="form-group">
						<input type="text" name="nombre" class="form-control" id="nombre-admin" required placeholder="Nombre" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+{2,50}">
						<input type="text" name="apellido" class="form-control" id="apellido-admin" required placeholder="Apellido" autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+{2,50}">
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" id="password-admin" placeholder="Contraseña" autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9.!?-\s]{4,20}">
						<input type="password" name="password-repeat" class="form-control" id="password-repeat" placeholder="Repetir contraseña" autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9.!?-\s]{4,20}">
						<input type="email" name="email" class="form-control" id="email-admin" placeholder="E-mail" autocomplete="off" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$">
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
		        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="self.parent.location.reload();">Cerrar</button>
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
		        <p>Ocurrió un error durante la carga de datos. Compruebe que el número de CC y el Email ingresados no existan en la base de datos y reinténtelo</p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- Fin Modal Error -->
	</div>
		<!-- Sección de modificación y eliminación de administradores -->
		<div id="modificar" class="tab pane fade">
			<div class="container">
				<br>
				<h4 class="text-center text-muted">Modificar datos de usuarios</h4>
				<br>
				<form  method="post" accept-charset="utf-8" id="busqueda-usuario">
						<input class="form-control" type="text" name="searchUser" id="searchUser" pattern="[A-Za-z0-9]{0-50}" placeholder="Buscar usuario...">	
						<br>
						<br>
						<div id="tabla-usuario">
							<!-- Tabla generada de manera dinámica -->
						</div>
				</form>
			</div>
		</div>
		<!-- Modal con Formulario de edición de usuario -->
				<div id="modal-modificar-admin" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="updateModalLabel">Modificar datos de usuarios</h5>
				        <button type="button" class="close" data-dismiss="modal">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				      <div id="success-admin" class="alert alert-success text-center" style="display: none;">Datos guardados correctamente.</div>
                    <div id="error-admin" class="alert alert-danger text-center" style="display: none;">Ocurrió un error durante la carga de datos. Vuelva a intentarlo</div>
				        <form action=" " method="POST" role="form" id="form-admin-modal" action="../save-admin-changes.php">
				        	<div class="form-group">
				        		<label class="text-muted" for="cc">Nº de CC</label>
				        		<input type="number" name="ccAdmin" class="form-control" id="ccAdmin" value="" pattern="[0-9]{8,10}">
				        	</div>
				        	<!-- Formulario generado dinámicamente por el sistema -->
				        </form>
				      </div>
				      <div class="modal-footer">
				        <input type="submit" form="form-admin-modal" class="btn btn-primary btnCerrar" value="Guardar cambios">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="self.parent.location.reload();">Cerrar</button>
				      </div>
				    </div>
				  </div>
				</div>
				<!-- Fin de Modal con Formulario de edición de usuario -->
				<!-- Modal de confirmación de eliminación -->
				<div id="advertenciaModalAdmin" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header" style="background-color: red;">
				        <h5 class="modal-title" id="deleteModalLabel" style="color: #FFF;">¡Atención!</h5>
				        <button type="button" class="close" data-dismiss="modal">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				       <div id="success-delete-admin" class="alert alert-success text-center" style="display: none;">Datos eliminados correctamente.</div>
                    	<div id="error-delete-admin" class="alert alert-danger text-center" style="display: none;">Ocurrió un error durante la operación. Vuelva a intentarlo</div>
				      <div class="modal-body">
				      <p>¿Realmente desea eliminar todos los datos del usuario? Esta acción es <strong>irreversible</strong></p>
				      </div>
				      <div class="modal-footer">
				      <form  method="POST" accept-charset="utf-8" id="eliminaradmin">
				      	<input type="number" name="cc-admin-eliminar" id="cc-admin-eliminar" hidden value="">
				      </form>
				        <button type="submit" class="btn btn-danger" value="confirm" form="eliminaradmin">Eliminar</button>
				        <button type="button" class="btn btn-secondary btnCerrar" data-dismiss="modal" onclick="self.parent.location.reload();">Cerrar</button>
				      </div>
				    </div>
				  </div>
				</div>
				<!-- Fin de Modal de confirmación de eliminación -->
		<!-- Fin de sección de modificación y eliminación de administradores -->
	</div>
</section>
<!-- Fin de Sección admin -->
	<?php include('../../includes_style/footer.php') ?>
	<?php include('../../includes_style/scripts-interior.php') ?>
</body>
</html>