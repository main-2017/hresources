<?php 
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require 'conexion.php';
	session_start();
	$mysqli->set_charset('utf8');
	$cc = $mysqli->real_escape_string($_POST['cc']);
	$nombre = $mysqli->real_escape_string($_POST['nombre']);
	$apellido = $mysqli->real_escape_string($_POST['apellido']);
	$pass = $mysqli->real_escape_string($_POST['password']);
	$rep_pass = $mysqli->real_escape_string($_POST['password-repeat']);
	$email = $mysqli->real_escape_string($_POST['email']);
	$rol = $mysqli->real_escape_string($_POST['rol']);
	$pass_cifrado = "";	
	$nombre_completo = $nombre." ".$apellido;
// Comparación de Email
$qemail = $mysqli->query("SELECT CC, Email FROM administradores WHERE Email = '".$email."';");
// Comnparación de CC
$qcc = $mysqli->query("SELECT CC, Email FROM administradores WHERE CC = '".$cc."';");
if ($qcc->num_rows > 0) {
	echo json_encode(array('error'=>true, 'msg' => "El CC ya existe"));
}elseif ($qemail->num_rows > 0) {
	echo json_encode(array('error'=>true, 'msg' => "El Email ya existe"));
}elseif (strcmp($pass, $rep_pass) !== 0) {
		echo json_encode(array('error' => true, 'msg' => "Las contraseñas no coinciden"));
	}else{
		$pass_cifrado = password_hash($pass, PASSWORD_DEFAULT);
		$carga = $mysqli->query("INSERT INTO administradores(CC, Nombre, Password, Email, Rol) VALUES('".$cc."', '".$nombre_completo."', '".$pass_cifrado."', '".$email."', '".$rol."');");
		if ($carga) {
			echo json_encode(array('error' => false));
		}else{
			echo json_encode(array('error' => true));
		}
	}
}
$mysqli->close();
?>