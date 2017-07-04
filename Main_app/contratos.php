<?php 
 if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
 	require 'conexion.php';
 	session_start();
 	$mysqli->set_charset('utf8');

 	$fechai = '';
 	$fechaf = '';
 	$aviso = '';
 	$tipo ='';
 	$ingreso ='';
 	$cc = '';
 	$bandera = false;
 	
 	if (isset($_POST['cc'])) {
		$cc = $mysqli->real_escape_string($_POST['cc']);
		
 	}

 	if (isset($_POST['Fecha_Inicio'])) {
		$fechai = $mysqli->real_escape_string($_POST['Fecha_Inicio']);
 		
 	}

 	if (isset($_POST['Fecha_Fin'])) {
		$fechaf = $mysqli->real_escape_string($_POST['Fecha_Fin']);
 		
 	}

 	if (isset($_POST['Alerta'])) {
		$aviso = $mysqli->real_escape_string($_POST['Alerta']);
 		
 	}

 	if (isset($_POST['tipo'])) {
		$tipo = $mysqli->real_escape_string($_POST['tipo']);
 		
 	}



	$final_int = strtotime($fechaf);
	$inicial_int = strtotime($fechai);

	$dif_alerta =  ($final_int - $aviso);
	$aviso_result = date('Y-m-d',$dif_alerta);

	if (($tipo == "Temporal 3 meses") && (($final_int - $inicial_int) <= 7948800)) {
			$bandera = true;
	}elseif (($tipo == "Temporal 1 año") && (($final_int - $inicial_int) <= 31622400)) {
			$bandera = true;
	}elseif ($tipo == "Indefinido") {
		$bandera = true;
	}else{
		$bandera = false;
	}

	if ($bandera) {
		$ingreso = $mysqli->query("INSERT INTO contratos(CC, Fecha_Inicio, Fecha_Fin, Tipo, Alerta1) VALUES('".$cc."', '".$fechai."', '".$fechaf."', '".$tipo."', '".$aviso_result."');");
	}else{
		$ingreso = false;
	}

	if ($ingreso) {
		echo json_encode(array('error' => false));
	}else{
		echo json_encode(array('error' => true));	
	}

 }
$mysqli->close();

 ?>