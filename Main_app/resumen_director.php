<?php 
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
require 'conexion.php';
session_start();
$mysqli->set_charset('utf8');
$resultado = $mysqli->query("SELECT CC, Nombre, Apellido, Estado FROM empleados");
$fila = $mysqli->real_escape_string(mysqli_num_rows($resultado));
$salida = " ";
$salida.="<table class='table'><thead><tr><td>CC</td><td>Nombre</td><td>Apellido</td><td>Estado</td></tr></thead><tbody>";
	while ($fila = $resultado->fetch_assoc()) {
		$salida.= "<tr>
					<td>".$fila['CC']."</td>
					<td>".$fila['Nombre']."</td>
					<td>".$fila['Apellido']."</td>
					<td>".$fila['Estado']."</td>					
					</tr>";
	}
	$salida.="</tbody></table>";

	echo $salida;
}

$mysqli->close();
 ?>