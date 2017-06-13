<?php 

// El Sistema se asegura de que se reciba una petición AJAX
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require 'conexion.php';
	session_start();
	$mysqli->set_charset('utf8');
// Filtrado de variables
	$user = $mysqli->real_escape_string($_POST['usuario']);
	$pass = $mysqli->real_escape_string($_POST['password']);

// Ejecución de consultas

$consulta1 = $mysqli->query("SELECT Nombre, Rol
	FROM administradores
	WHERE CC = '".$user."'
	AND Password = '".$pass."' 
	");
}

// Comprobación de datos recibidos por las consultas

if($consulta1->num_rows == 1) {
	$usuarios = $consulta1;
}

// Envio de respuesta del servidor

if ($usuarios->num_rows == 1) {
	$datos = $usuarios->fetch_assoc();
	$_SESSION['user'] = $datos;
	echo json_encode(array('error' => false, 'rol' => $datos['Rol']));
}else{
	echo json_encode(array('error' => true));
}

$mysqli->close();	

 ?>