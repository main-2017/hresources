<!-- Guardado de datos actualizados en la tabla contratos -->
<?php 
 if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require 'conexion.php';
	session_start();
	$mysqli->set_charset('utf8');
	$id = $mysqli->real_escape_string($_POST['id']);
	$cc = $mysqli->real_escape_string($_POST['cc']);
	$fechaInicio = $mysqli->real_escape_string($_POST['fechaInicio']);
	$fechaFin = $mysqli->real_escape_string($_POST['fechaFin']);
	$tipo = $mysqli->real_escape_string($_POST['tipo']);
	$alerta = $mysqli->real_escape_string($_POST['Alerta']);

	$final_int = strtotime($fechaFin);

	$dif_alerta =  ($final_int - $alerta);
	$aviso_result = date('Y-m-d',$dif_alerta);
	
	$query = $mysqli->query("UPDATE contratos SET ID = '$id', CC = '$cc', Fecha_inicio = '$fechaInicio', Fecha_Fin = '$fechaFin', Tipo = '$tipo', Alerta1 = '$aviso_result' WHERE ID = '$id'");

if ($query) {
 	echo json_encode(array('error' => false));
 }else{
 	echo json_encode(array('error' => true));
 }
$mysqli->close();
 }
 ?>