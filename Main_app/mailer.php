<!-- Envío de mails de alerta -->
<?php 
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require 'conexion.php';
	session_start();
	$mysqli->set_charset('utf8');
	$destinos = $mysqli->query("SELECT Nombre, Email FROM administradores WHERE Destinatarios = 1");
	$filas = mysqli_num_rows($destinos);
	$destinatarios = '';

	if ($destinos > 0) {
		while ($filas = $destinos->fetch_assoc() ) {
			$destinatarios.= " '".$filas['Email']."',";
		}
	}else{
		$destinatarios = " ";
	}

	$serverDate = date('Y-m-d');
	$consultaVencimientos = $mysqli->query("SELECT ID, CC, Fecha_Fin, Tipo, Alerta1 FROM contratos WHERE (Alerta1 >= '$serverDate') AND (Enviado = 0) ORDER BY Fecha_Fin;");
	$filasEmpleados = mysqli_num_rows($consultaVencimientos);
	$mensaje = '';
	if (($consultaVencimientos > 0)&&(!empty($destinatarios))) {
		$mensaje.= "Los contratos que se detallan a continuación están próximos a vencerse: </br>";
		while ($filasEmpleados = $consultaVencimientos->fetch_assoc()) {
			$mensaje.="Contrato Nº ".$filasEmpleados['ID']." correspondiente al CC Nº ".$filasEmpleados['CC']." del tipo ".$filasEmpleados['Tipo']." con vencimiento el día ".$filasEmpleados['Fecha_Fin']."</br>";
		}
	$mensaje.="</br>Diseñado y desarrollado por Main Group</br>";
	$subject = "hResource - Alerta de Vencimientos inminentes";	
	$headers = 'From: hresource@main-group.net' . "\r\n" .
    			'X-Mailer: PHP/' . phpversion();

    			if(mail($destinatarios, $subject, $mensaje, $headers)){
    				foreach ($filasEmpleados['ID'] as $contrato) {
    					$mysqli->query("UPDATE contratos SET Enviado = 1 WHERE ID = '$contrato';");
    				}
    			}else{
    				echo "Error al enviar el mail. Contacte al administrador";
    			}
	}
}

$mysqli->close();

 ?>