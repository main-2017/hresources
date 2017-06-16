<!-- Búsqueda en tiempo real de contratos -->
<?php 
 if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
 	require 'conexion.php';
 	session_start();
 	$mysqli->set_charset('utf8');
 	$salida = "";
	$query = "SELECT * FROM contratos ORDER BY ID;";
	if (isset($_POST['consulta'])) {
 		$q = $mysqli->real_escape_string($_POST['consulta']);
 		$query = "SELECT * FROM contratos WHERE ID LIKE '%".$q."%' OR CC LIKE '%".$q."%' OR Tipo LIKE '%".$q."%';";
 	}
 	$resultado = $mysqli->query($query);

 	if ($resultado->num_rows > 0) {
		$salida.="<table class='table'><thead style='background-color:#337ab7; color:#FFF;'><tr><td>ID</td><td>CC</td><td>Fecha de Inicio</td><td>Fecha de Fin</td><td>Tipo</td></tr></thead><tbody>";
		while ($fila = $resultado->fetch_assoc()) {
		$salida.= "<tr>
					<td><input type='number' name='id-contract[]' value='".$fila['ID']."' readonly style='border:none;'></td>
					<td><input type='number' name='cc-contract[]' value='".$fila['CC']."' readonly style='border:none;'></td>
					<td><input type='date' name='fecha-inicio[]' value='".$fila['Fecha_inicio']."' readonly style='border:none;'></td>
					<td><input type='date' name='fecha-fin[]' value='".$fila['Fecha_Fin']."' readonly style='border:none;'></td>
					<td><input type='text' name='tipo[]' value='".$fila['Tipo']."' readonly style='border:none;'></td>";
					
					if ($_SESSION['user']['Rol'] == 'Administrador') {
					$salida.="<td><button type='button' class='open-modal-contract btn btn-primary' name='modificar[]' value='".$fila['ID']."' data-toggle='modal' data-target='#modal-modificar-contrato'>Modificar</button></td><td><button type='button' class='eliminar-contrato btn btn-danger' data-toggle='modal' data-target='#advertenciaModalContratos' name='eliminar[]' value='".$fila['ID']."'>Eliminar</button></td></tr>";
					}elseif ($_SESSION['user']['Rol'] == 'Matriculador') {
						$salida.="<td><button type='button' class='open-modal-contract btn btn-primary' name='modificar[]' value='".$fila['ID']."' data-toggle='modal' data-target='#modal-modificar-contrato'>Modificar</button></td></tr>";
					}else{
						$salida.="<tr>";
					}
			}
		$salida.="</tbody></table>";
	}else{
		$salida.= "No hay registros para mostrar";
	}

	echo $salida;
	
 }
 	$mysqli->close();
 ?>