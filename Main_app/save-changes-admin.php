<!-- Guardado de datos actualizados en la tabla administradores -->
<?php 
 if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require 'conexion.php';
	session_start();
	$mysqli->set_charset('utf8');
	$cc = $mysqli->real_escape_string($_POST['cc']);
	$nombre = $mysqli->real_escape_string($_POST['nombre']);
	$email = $mysqli->real_escape_string($_POST['email']);
	$rol = $mysqli->real_escape_string($_POST['rol']);
	
	$query = $mysqli->query("UPDATE administradores SET CC = '$cc', Nombre = '$nombre', Email = '$email', Rol = '$rol' WHERE CC = '$cc';");

if ($query) {
 	echo json_encode(array('error' => false));
 }else{
 	echo json_encode(array('error' => true));
 }
$mysqli->close();
 }
 ?>