<!-- Busqueda en tiempo real de empleados -->
<?php 
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require 'conexion.php';
	session_start();
	$mysqli->set_charset('utf8');
	$salida = "";
	$query = "SELECT * FROM empleados ORDER BY CC;";

	if (isset($_POST['consulta'])) {
		$q = $mysqli->real_escape_string($_POST['consulta']);
		$query = "SELECT * FROM empleados WHERE CC LIKE '%".$q."%' OR Nombre LIKE '%".$q."%' OR Apellido LIKE '%".$q."%';";
	}

	$resultado = $mysqli->query($query);

	if ($resultado->num_rows > 0) {
		$salida.="<table class='table'><thead style='background-color:#337ab7; color:#FFF;'><tr><td>CC</td><td>Nombre</td><td>Apellido</td><td>Domicilio</td><td>Estado</td></tr></thead><tbody>";
		while ($fila = $resultado->fetch_assoc()) {
		$salida.= "<tr>
					<td><input type='number' name='cc[]' value='".$fila['CC']."' readonly style='border:none;'></td>
					<td><input type='text' name='nombre[]' value='".$fila['Nombre']."' readonly style='border:none;'></td>
					<td><input type='text' name='apellido[]' value='".$fila['Apellido']."' readonly style='border:none;'></td>
					<td><input type='text' name='nacionalidad[]' value='".$fila['Domicilio']."' readonly style='border:none;'></td>
					<td><input type='text' name='estado[]' value='".$fila['Estado']."' readonly style='border:none;'></td>";
					

					$salida.="<td><button type='button' class='btn btn-primary' name='modificar[]' value='".$fila['CC']."' data-toggle='modal' data-target='#modal-modificar-empleado'>Modificar</button></td><td><button class='btn btn-danger' name='eliminar[]' value='".$fila['CC']."'>Eliminar</button></td></tr>";
			}
		$salida.="</tbody></table>";
	}else{
		$salida.= "No hay registros para mostrar";
	}
	
	echo $salida;
}

$mysqli->close();

 ?>