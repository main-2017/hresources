<!-- Guarda los cambios provinientes de la actualización de empleados a través de ventanas emergentes -->
<?php 
 if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require 'conexion.php';
	session_start();
	$mysqli->set_charset('utf8');
	$cc = $mysqli->real_escape_string($_POST['cc']);
	$nombre = $mysqli->real_escape_string($_POST['nombre']);
	$apellido = $mysqli->real_escape_string($_POST['apellido']);
	$telefono = $mysqli->real_escape_string($_POST['telefono']);
	$celular = $mysqli->real_escape_string($_POST['celular']);
	$domicilio = $mysqli->real_escape_string($_POST['domicilio']);
	$nacionalidad = $mysqli->real_escape_string($_POST['nacionalidad']);
	$sexo = $mysqli->real_escape_string($_POST['sexo']);
	$estado = $mysqli->real_escape_string($_POST['estado']);

	$query = $mysqli->query("UPDATE empleados SET CC = '$cc', Nombre = '$nombre', Apellido = '$apellido', Telefono = '$telefono', Celular = '$celular', Domicilio = '$domicilio', Nacionalidad = '$nacionalidad', Sexo = '$sexo', Estado = '$estado' WHERE CC = '$cc'");

if ($query) {
 	echo json_encode(array('error' => false));
 }else{
 	echo json_encode(array('error' => true));
 }
$mysqli->close();
 }

 ?>