<!-- Elimina datos de la tabla empleados -->
<?php 
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require 'conexion.php';
	session_start();
	$mysqli->set_charset('utf8');
	$cc = $mysqli->real_escape_string($_POST['cc-empleado-eliminar']);
	$query = $mysqli->query("DELETE FROM empleados WHERE CC = '$cc'");
	if ($query) {
		echo json_encode(array('error' => false));
	}else{
		echo json_encode(array('error' => true));
	}
}
$mysqli->close();
 ?>