<?php 
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require 'conexion.php';
	session_start();
	$mysqli->set_charset('utf8');
	$resultado = $mysqli->query("SELECT CC, Nombre, Email, Rol, Destinatarios FROM administradores WHERE CC > 0");
	$fila = $mysqli->real_escape_string(mysqli_num_rows($resultado));
	$checked = "checked";
	$salida = " ";
	$salida.="<table class='table' id='admin-mail'><thead><tr><td>CC</td><td>Nombre</td><td>Email</td><td>Rol</td></tr></thead><tbody>";
	while ($fila = $resultado->fetch_assoc()) {
		$salida.= "<tr>
					<td><input type='number' form='form-check' value='".$fila['CC']."' readonly style='border:none;' name='cc[]'></td>
					<td>".$fila['Nombre']."</td>
					<td>".$fila['Email']."</td>
					<td>".$fila['Rol']."</td>";

				if ($fila['Destinatarios'] == 1) {
					$salida.= "<td><div class='checkbox'><select class='form-control' form='form-check' name='destinatario[]'><option value='".$fila['CC']."'>Enviar</option><option value='".$fila['CC'].'a'."'>No Enviar</option></select></div></td>
					</tr>";
				}else{
					$salida.= "<td><div class='checkbox'><select class='form-control' form='form-check' name='destinatario[]'><option value='".$fila['CC'].'a'."'>No Enviar</option><option value='".$fila['CC']."'>Enviar</option></select></div></td>
					</tr>";
				}
					
	}
	$salida.="</tbody></table>";

	echo $salida;
}

$mysqli->close();

 ?>