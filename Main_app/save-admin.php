<?php 
// Guardado de destinatarios de alertas en tabla administradores
	require 'conexion.php';
	session_start();
	$mysqli->set_charset('utf8');
		foreach ($_POST['destinatario'] as $destinatario) {
			if (substr($destinatario, -1) == 'a') {
				$rest = substr($destinatario, 0, -1);
				$actualizar = $mysqli->query("UPDATE administradores SET Destinatarios = 0 WHERE CC = '$rest';");
			}else{
				$actualizar = $mysqli->query("UPDATE administradores SET Destinatarios = 1 WHERE CC = '$destinatario';");	
			}
			
			
		}
		header('Location: admin/gestion.php');
	$mysqli->close();

 ?>