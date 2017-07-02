<!-- Carga de formulario dinámico en Modal de Actualización de usuario -->
<?php 
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require 'conexion.php';
	session_start();
	$mysqli->set_charset('utf8');
	$searchCC = $mysqli->real_escape_string($_POST['input']);
	$query = $mysqli->query("SELECT * FROM empleados WHERE CC = '$searchCC'");
	$salida= '';
	if ($query->mysqli_num_rows = 1) {
		$array = $query->fetch_assoc();
		$salida.= "<div class='form-group'>
						<label class='text-muted' for='cc'>Nº de CC</label>
						<input type='number' name='cc' class='form-control' id='cc' value='".$array['CC']."'>
					</div>
					<div class='form-group'>
						<label class='text-muted' for='nombre'>Nombre</label>
						<input type='text' name='nombre' class='form-control' id='nombre' pattern='[A-Za-z ]{2,50}' value='".$array['Nombre']."'>
					</div>
					<div class='form-group'>
						<label class='text-muted' for='apellido'>Apellido</label>
						<input type='text' name='apellido' class='form-control' id='apellido' pattern='[A-Za-z ]{2,50}' value='".$array['Apellido']."'>
					</div>
					<div class='form-group'>
						<label class='text-muted' for='telefono'>Telefono</label>
						<input type='tel' name='telefono' class='form-control' id='telefono' pattern='[0-9]{5-12}' value='".$array['Telefono']."'>
					</div>
					<div class='form-group'>
						<label class='text-muted' for='celular'>Celular</label>
						<input type='tel' name='celular' class='form-control' id='celular' pattern='[0-9]{5-12}' value='".$array['Celular']."'>
					</div>
					<div class='form-group'>
						 <label class='text-muted' for='domicilio'>Domicilio</label>
						 <input type='text' name='domicilio' class='form-control' id='domicilio' pattern='[A-Za-z0-9 ]{2,70}' value='".$array['Domicilio']."'>
					</div>
					<div class='form-group'>
						 <label class='text-muted' for='nacionalidad'>Nacionalidad</label>
						 <input type='text' name='nacionalidad' class='form-control' id='nacionalidad' pattern='[A-Za-z ]{2,70}' value='".$array['Nacionalidad']."'>
					</div>
					<div class='form-group'>
						<label class='text-muted' for='email'>Email</label>
						<input type='email' name='email' class='form-control' id='email' pattern='^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$' value='".$array['Email']."'>
					</div>
					<div class='form-group>
						<label class='text-muted' for='departamento'>Departamento</label>
						<input type='text' name='departamento' class='form-control' id='departamento' pattern='[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+{2,100}' value='".$array['Departamento']."'>
						<label class='text-muted' for='ciudad'>Ciudad</label>
						<input type='text' name='ciudad' class='form-control' id='ciudad' pattern='[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+{2,100}' value='".$array['Ciudad']."'>
					</div>
					<div class='radio'>
						<h5 class='text-muted text-center'>Sexo</h5>";
					if ($array['Sexo'] == 'masculino') {
						$salida.="<div style='width: 200px;display: block;margin: auto;'>
									<label><input id='masculino' type='radio' name='sexo' value='masculino' checked>Masculino</label>
									<label><input id='femenino' type='radio' name='sexo' value='femenino'>Femenino</label>
								</div>";		
					}else{
						$salida.="<div style='width: 200px;display: block;margin: auto;'>
									<label><input id='masculino' type='radio' name='sexo' value='masculino'>Masculino</label>
									<label><input id='femenino' type='radio' name='sexo' value='femenino' checked>Femenino</label>
								</div>";	
					}

					$salida.= "<br>
								<h5 class='text-muted text-center'>Estado</h5>";
						
					if ($array['Estado'] == 'Activo') {
						$salida.="<select class='form-control' name='estado'>
									<option value='Activo'>Activo</option>
									<option value='Inactivo'>Inactivo</option>
									<option value='Renuncio'>Renunció</option>
									<option value='Contrato terminado'>Contrato terminado</option>
									<option value='Reingreso'>Reingreso</option>
								</select>";
					}elseif ($array['Estado'] == 'Inactivo') {
						$salida.="<select class='form-control' name='estado'>
									<option value='Inactivo'>Inactivo</option>
									<option value='Activo'>Activo</option>
									<option value='Renuncio'>Renunció</option>
									<option value='Contrato terminado'>Contrato terminado</option>
									<option value='Reingreso'>Reingreso</option>
								</select>";
					}elseif ($array['Estado'] == 'Renuncio') {
						$salida.="<select class='form-control' name='estado'>
									<option value='Renuncio'>Renunció</option>
									<option value='Inactivo'>Inactivo</option>
									<option value='Activo'>Activo</option>
									<option value='Contrato terminado'>Contrato terminado</option>
									<option value='Reingreso'>Reingreso</option>
								</select>";
					}elseif ($array['Estado'] == 'Contrato terminado') {
						$salida.="<select class='form-control' name='estado'>
									<option value='Contrato terminado'>Contrato terminado</option>
									<option value='Inactivo'>Inactivo</option>
									<option value='Activo'>Activo</option>
									<option value='Renuncio'>Renunció</option>
									<option value='Reingreso'>Reingreso</option>
								</select>";
					}elseif ($array['Estado'] == 'Reingreso') {
						$salida.="<select class='form-control' name='estado'>
									<option value='Reingreso'>Reingreso</option>
									<option value='Inactivo'>Inactivo</option>
									<option value='Activo'>Activo</option>
									<option value='Renuncio'>Renunció</option>
									<option value='Contrato terminado'>Contrato terminado</option>
								</select>";
					}
					$salida.= "<br>
								<div class='form-group'>
									<label class='text-muted' for='observaciones'>Observaciones</label>
									<br>
									<textarea class='form-control' name='observaciones' rows='5' maxlength='1000' resize='none'>".$array['Observaciones']."</textarea>
								</div>";

								
			}else{
				$salida = "No hay datos para mostrar";
				
			}
				echo $salida;				

	}
$mysqli->close();

 ?>