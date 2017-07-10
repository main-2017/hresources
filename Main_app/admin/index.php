<!-- Index Administrador General -->

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
			    <li class="disabled"><a href="#">Panel</a></li>
			    <li><a href="gestion.php">Alertas</a></li>
			    <li><a href="new_user.php">Gestión de usuarios</a></li>
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
		  <li class="active"><a href="#ingresar" data-toggle="tab">Ingresar</a></li>
		  <li><a href="#modificar" data-toggle="tab">Modificar o Eliminar</a></li>
		</ul>
		<div class="tab-content">
			<div id="ingresar" class="tab-pane fade in active">
				<div class="container">
				<br>
				<h4 class="text-center text-muted">Ingreso de nuevos empleados</h4>
				<br>
					<form class="form col-lg-offset-2 col-lg-8 col-md-10 col-xs-12" role="form" id="ingresar-empleado" method="POST">
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
						<div class="form-group">
							<input type="email" name="email" class="form-control" id="email-empleado" placeholder="Email" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$">													
						</div>
						<div class="form-group">
							<input type="text" name="departamento" class="form-control" id="departamento-empleado" placeholder="Departamento" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+{2,100}">
							<input type="text" name="ciudad" class="form-control" id="ciudad-empleado" placeholder="Ciudad" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+{2,100}">
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
						<div class="form-group">
							<textarea  class="form-control" name="observaciones" placeholder="Observaciones" rows="5" maxlength="1000" resize="none"></textarea>
						</div>
						<br>
						<hr>
						<div style="float: right;">
							<button type="reset" class="btn btn-danger">Borrar</button>
							<button type="submit" class="btn btn-success">Guardar</button>
						</div>
					</form>
				</div>
			</div>
			<div class="tab-pane fade" id="modificar">
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
				<!-- Modal con Formulario de edición de empleado -->
				<div id="modal-modificar-empleado" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title">Modificar datos de empleado</h5>
				        <button type="button" class="close" data-dismiss="modal">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				      <div id="success" class="alert alert-success text-center" style="display: none;">Datos guardados correctamente.</div>
                    <div id="error" class="alert alert-danger text-center" style="display: none;">Ocurrió un error durante la carga de datos. Vuelva a intentarlo</div>
				        <form action=" " method="POST" role="form" id="form-data-modal" action="../save-changes.php">
				        	<div class="form-group">
				        		<label class="text-muted" for="cc">Nº de CC</label>
				        		<input type="number" name="ccEmpleado" class="form-control" id="cc" value="" pattern="[0-9]{8,10}">
				        	</div>
				        	<!-- Formulario generado dinámicamente por el sistema -->
				        </form>
				      </div>
				      <div class="modal-footer">
				        <input type="submit" form="form-data-modal" class="btn btn-primary" value="Guardar cambios">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="self.parent.location.reload();">Cerrar</button>
				      </div>
				    </div>
				  </div>
				</div>
				<!-- Fin de Modal con Formulario de edición de empleado -->
				</div>
				<!-- Modal de confirmación de eliminación -->
				<div id="advertenciaModal" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header" style="background-color: red;">
				        <h5 class="modal-title" style="color: #FFF;">¡Atención!</h5>
				        <button type="button" class="close" data-dismiss="modal">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				       <div id="success-delete" class="alert alert-success text-center" style="display: none;">Datos eliminados correctamente.</div>
                    	<div id="error-delete" class="alert alert-danger text-center" style="display: none;">Ocurrió un error durante la operación. Vuelva a intentarlo</div>
				      <div class="modal-body">
				      <p>¿Realmente desea eliminar todos los datos del empleado? Esta acción es <strong>irreversible</strong></p>
				      </div>
				      <div class="modal-footer">
				      <form  method="POST" accept-charset="utf-8" id="eliminarEmpleado">
				      	<input type="numer" name="cc-empleado-eliminar" id="cc-empleado-eliminar" hidden value="">
				      </form>
				        <button type="submit" class="btn btn-danger" value="confirm" form="eliminarEmpleado">Eliminar</button>
				        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="self.parent.location.reload();">Cerrar</button>
				      </div>
				    </div>
				  </div>
				</div>
				<!-- Fin de Modal de confirmación de eliminación -->
			</div>
			
		</div>
		<!-- Ventana Modal de confirmación y error -->
		<!-- Modal Exito-->
		<div class="modal fade" id="exitoEmpleado" tabindex="-1" role="dialog" aria-labelledby="exitoEmpleadoLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header" style="background-color: #337ab7;">
		        <h4 class="modal-title" id="exitoEmpleadoLabel" style="color: #FFF;">Carga Exitosa</h4>
		       
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
		<div class="modal fade" id="errorEmpleado" tabindex="-1" role="dialog" aria-labelledby="errorEmpleadoLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header" style="background-color: red;">
		        <h4 class="modal-title" id="errorEmpleadoLabel" style="color: #FFF;">Error de carga</h4>
		      </div>
		      <div class="modal-body">
		        <p>Ocurrió un error durante la carga de datos. Compruebe que el número de CC ingresado no exista en la base de datos y reinténtelo</p>
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
	<section id="contratos" class="tab-pane fade">
		<ul class="nav nav-tabs nav-justified">
		  <li class="active"><a href="#ingresar-contrato" data-toggle="tab">Ingresar</a></li>
		  <li><a href="#modificar-contrato" data-toggle="tab">Modificar o Eliminar</a></li>
		</ul>
		<div class="tab-content">
			<div id="ingresar-contrato" class="tab-pane fade in active">
				<div class="container">
					<br>
					<h4 class="text-center text-muted">Carga de nuevos contratos</h4>
					<br>
					<form id="cargar-contrato" class="form col-lg-offset-2 col-lg-8 col-md-10 col-xs-12" method="POST">
						<div class="form-group">
							<h5 class="text-center text-muted">Empleado</h5>
							<select name="cc" class="form-control" id="select-contratos" required>
								<!-- Options generados dinámicamente -->
							</select>
						</div>
						<h5 class="text-muted text-center">Tipo de contrato</h5>
						<select class="form-control" name="tipo">
							<option value="Temporal 3 meses">Temporal 3 meses</option>
							<option value="Temporal 1 año">Temporal 1 año</option>
							<option value="Indefinido">Indefinido</option>
						</select>
						<div class="form-group">
							<br>
							<h5 class="text-muted text-center">Fechas inicio y finalización de contrato</h5>
							<br>
							<input type="date" name="Fecha_Inicio" class="form-control" id="Fecha_Inicio" required placeholder="Fecha de inicio del contrato. Formato 'AAAA/MM/DD'">
									
							<input type="date" name="Fecha_Fin" class="form-control" id="Fecha_Fin" required placeholder="Fecha de Finalización del contrato. Formato 'AAAA/MM/DD'">
						</div>
						<br>
						
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
			<!-- Sección de Modificación y eliminación de contratos -->
			<div id="modificar-contrato" class="tab-pane fade">
				<div class="container">
					<br>
					<h4 class="text-center text-muted">Modificar contratos cargados</h4>
					<br>
					<form  method="post" accept-charset="utf-8" id="busqueda-contrado-md">
							<input class="form-control" type="text" name="searchContract" id="searchContract" pattern="[A-Za-z0-9]{1-50}" placeholder="Buscar contrato...">	
							<br>
							<br>
							<div id="tabla-contrato">
								<!-- Tabla generada de manera dinámica -->
							</div>
					</form>
					<!-- Modal con Formulario de edición de contratos -->
						<div id="modal-modificar-contrato" class="modal fade" role="dialog">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title">Modificar contratos cargados</h5>
						        <button type="button" class="close" data-dismiss="modal">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						      <div id="successContract" class="alert alert-success text-center" style="display: none;">Datos guardados correctamente.</div>
		                    <div id="errorContract" class="alert alert-danger text-center" style="display: none;">Ocurrió un error durante la carga de datos. Vuelva a intentarlo</div>
						        <form action=" " method="POST" role="form" id="form-contract-modal">
						        	<div class="form-group">
						        		<label class="text-muted" for="id-contract"></label>
						        		<input type="number" name="idContrato" class="form-control" id="id-contract" value="" pattern="[0-9]{1,10}">
						        	</div>
						        	<!-- Formulario generado dinámicamente por el sistema -->
						        </form>
						      </div>
						      <div class="modal-footer">
						        <input type="submit" form="form-contract-modal" class="btn btn-primary" value="Guardar cambios">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="self.parent.location.reload();">Cerrar</button>
						      </div>
						    </div>
						  </div>
						</div>
				<!-- Fin de Modal con Formulario de edición de contratos -->

				<!-- Modal de confirmación de eliminación -->
				<div id="advertenciaModalContratos" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header" style="background-color: red;">
				        <h5 class="modal-title" style="color: #FFF;">¡Atención!</h5>
				        <button type="button" class="close" data-dismiss="modal">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				       <div id="success-delete-contract" class="alert alert-success text-center" style="display: none;">Datos eliminados correctamente.</div>
                    	<div id="error-delete-contract" class="alert alert-danger text-center" style="display: none;">Ocurrió un error durante la operación. Vuelva a intentarlo</div>
				      <div class="modal-body">
				      <p>¿Realmente desea eliminar todos los datos del contrato? Esta acción es <strong>irreversible</strong></p>
				      </div>
				      <div class="modal-footer">
				      <form  method="POST" accept-charset="utf-8" id="eliminarContrato">
				      	<input type="numer" name="cc-contrato-eliminar" id="cc-contrato-eliminar" hidden value="">
				      </form>
				        <button type="submit" class="btn btn-danger" value="confirm" form="eliminarContrato">Eliminar</button>
				        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="self.parent.location.reload();">Cerrar</button>
				      </div>
				    </div>
				  </div>
				</div>
				<!-- Fin de Modal de confirmación de eliminación -->
				</div>
			</div>
			<!-- Fin de sección de Modificación y eliminación de contratos -->
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
		        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="self.parent.location.reload();">Cerrar</button>
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
		        <p>Ocurrió un error durante la carga de datos. Compruebe que las fechas de inicio y finalización de contrato se correspondan con el tipo de contrato definido y reinténtelo</p>
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
</div>
	
	<?php include('../../includes_style/footer.php') ?>
	<?php include('../../includes_style/scripts-interior.php') ?>
</body>
</html>






