<?php 
 if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
 	require 'conexion.php';
 	session_start();
 	$mysqli->set_charset('utf8');
	$cc = $mysqli->real_escape_string($_POST['cc']);
	$fechai = $mysqli->real_escape_string($_POST['Fecha_Inicio']);
	$fechaf = $mysqli->real_escape_string($_POST['Fecha_Fin']);
	$aviso = $mysqli->real_escape_string($_POST['Alerta']);
	$tipo = $mysqli->real_escape_string($_POST['tipo']);

$alerta = strtotime($fechaf);
$dif_alerta =  ($alerta - $aviso);
$aviso_result = date('Y-m-d',$dif_alerta);

echo $aviso_result;

$ingreso = $mysqli->query("INSERT INTO contratos(CC, Fecha_Inicio, Fecha_Fin, Tipo, Alerta1) VALUES('".$cc."', '".$fechai."', '".$fechaf."', '".$tipo."', '".$aviso_result."');");

if ($ingreso) {
	echo json_encode(array('error' => false));
}else{
	echo json_encode(array('error' => true));	
}

 }
$mysqli->close();

 ?>