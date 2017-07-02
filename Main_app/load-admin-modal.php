<!-- Carga en ventana modal de formulario dinámico para modificación de usuarios -->
<?php 
 if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require 'conexion.php';
	session_start();
	$mysqli->set_charset('utf8');
	$searchID = $mysqli->real_escape_string($_POST['input']);
	$query = $mysqli->query("SELECT CC, Nombre, Email, Rol FROM administradores WHERE cc = '$searchID'");
	$salida= '';
	if ($query->mysqli_num_rows = 1) {
		$array = $query->fetch_assoc();
		$salida.= "<div class='form-group'>
						<label class='text-muted' for='id'>CC de Usuario</label>
						<input type='number' name='cc' class='form-control' id='cc' value='".$array['CC']."'>
					</div>
					<div class='form-group'>
						<label class='text-muted' for='nombre'>Nombre y Apellido</label>
						<input type='text' name='nombre' class='form-control' id='nombre' pattern='[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+{2,100}' value='".$array['Nombre']."'>
					</div>
					<div class='form-group'>
						<label class='text-muted' for='email'>Email</label>
						<input type='email' name='email' class='form-control' id='email' pattern='^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$' value='".$array['Email']."'>
					</div>";
					
					$salida.= "<br>
								<h5 class='text-muted text-center'>Rol</h5>";
						
					if ($array['Rol'] == 'Administrador') {
						$salida.="<select class='form-control' name='rol'>
									<option value='Administrador'>Administrador</option>
									<option value='Director'>Director</option>
									<option value='Matriculador'>Matriculador</option>
								</select>";
					}elseif ($array['Rol'] == 'Director') {
						$salida.="<select class='form-control' name='rol'>
									<option value='Director'>Director</option>
									<option value='Administrador'>Administrador</option>
									<option value='Matriculador'>Matriculador</option>
								</select>";
					}elseif ($array['Rol'] == 'Matriculador') {
						$salida.= "<select class='form-control' name='rol'>
									<option value='Matriculador'>Matriculador</option>
									<option value='Administrador'>Administrador</option>
									<option value='Director'>Director</option>
								 </select>";
					}

										
			}else{
				$salida = "No hay datos para mostrar";
				
			}
				echo $salida;				

	}
$mysqli->close();
 ?>