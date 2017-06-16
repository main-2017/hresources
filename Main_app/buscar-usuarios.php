<!-- Búsqueda en tiempo real de usuarios -->
<?php 
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require 'conexion.php';
	session_start();
	$mysqli->set_charset('utf8');
	$salida = "";
	$query = "SELECT CC, Nombre, Email, Rol FROM administradores WHERE CC != 0 ORDER BY CC;";
	if (isset($_POST['consulta'])) {
		$q = $mysqli->real_escape_string($_POST['consulta']);
		$query = "SELECT CC, Nombre, Email, Rol FROM administradores WHERE CC LIKE '%".$q."%' OR Nombre LIKE '%".$q."%' OR Rol LIKE '%".$q."%';";
		}
		$resultado = $mysqli->query($query);
		if ($resultado->num_rows > 0) {
			$salida.="<table class='table'><thead style='background-color:#337ab7; color:#FFF;'><tr><td>CC</td><td>Nombre y Apellido</td><td>E-mail</td><td>Rol</td></tr></thead><tbody>";
			while ($fila = $resultado->fetch_assoc()) {	
				$salida.= "<tr>
					<td><input type='number' name='cc[]' value='".$fila['CC']."' readonly style='border:none;'></td>
					<td><input type='text' name='nombre[]' value='".$fila['Nombre']."' readonly style='border:none;'></td>
					<td><input type='email' name='email[]' value='".$fila['Email']."' readonly style='border:none;'></td>
					<td><input type='text' name='rol[]' value='".$fila['Rol']."' readonly style='border:none;'></td>";
					
					$salida.="<td><button type='button' class='modal-admin btn btn-primary' name='modificar[]' value='".$fila['CC']."' data-toggle='modal' data-target='#modal-modificar-admin'>Modificar</button></td><td><button type='button' class='eliminar-admin btn btn-danger' data-toggle='modal' data-target='#advertenciaModalAdmin' name='eliminar[]' value='".$fila['CC']."'>Eliminar</button></td></tr>";
				}
			$salida.="</tbody></table>";
		}else{
			$salida.= "No hay registros para mostrar";
		}
		echo $salida;

}

$mysqli->close();
 ?>