<!-- Elimina datos de la tabla administradores -->
<?php 
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require 'conexion.php';
	session_start();
	$mysqli->set_charset('utf8');
	$id = $mysqli->real_escape_string($_POST['cc-admin-eliminar']);
	$query = $mysqli->query("DELETE FROM administradores WHERE CC = '$id';");
	if ($query) {
		echo json_encode(array('error' => false));
	}else{
		echo json_encode(array('error' => true));
	}
}
$mysqli->close();
?>