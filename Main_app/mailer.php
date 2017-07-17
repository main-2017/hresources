<?php
// Envio de alertas por mail 
/**
 * @version 1.0
 */

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require 'conexion.php';
	require 'class.phpmailer.php';
	require 'class.smtp.php';
	session_start();
	$mysqli->set_charset('utf8');
	$active = $mysqli->real_escape_string($_POST['activacion']);
	$actualizacion = '';

	if ($active == 1) {
			$destinos = $mysqli->query("SELECT Nombre, Email FROM administradores WHERE Destinatarios = 1");
			$filas = mysqli_num_rows($destinos);
					
			if ($destinos->num_rows > 0) {
				while ($filas = $destinos->fetch_assoc() ) {
						$destinatarios = array($filas['Email'] => $filas['Nombre']);	
				}
			}

			
			$serverDate = date('Y-m-d');

			$consultaVencimientos = $mysqli->query("SELECT ID, CC, Fecha_Fin, Tipo, Alerta1 FROM contratos WHERE (Alerta1 <= '$serverDate') AND (Enviado = 0) ORDER BY Fecha_Fin;");
			$filasEmpleados = mysqli_num_rows($consultaVencimientos);
			$mensaje = '';
			if (($consultaVencimientos->num_rows > 0)&&(!empty($destinatarios))) {
				$mensaje.= "Los contratos que se detallan a continuación están próximos a vencerse: <br/>";
				while ($filasEmpleados = $consultaVencimientos->fetch_assoc()) {
					$mensaje.="Contrato Nº ".$filasEmpleados['ID']." correspondiente al CC Nº ".$filasEmpleados['CC']." del tipo ".$filasEmpleados['Tipo']." con vencimiento el día ".$filasEmpleados['Fecha_Fin']."<br>";
					$updater = array(
						$filasEmpleados['ID']
						);

				}
					// Datos de la cuenta de correo utilizada para enviar vía SMTP
					$smtpHost = "c0710238.ferozo.com";  // Dominio alternativo brindado en el email de alta 
					$smtpUsuario = "hresources@c0710238.ferozo.com";  // Mi cuenta de correo
					$smtpClave = "@Bvqn@t5sU";  // Mi contraseña

					// Email donde se enviaran los datos cargados en el formulario de contacto


					$mail = new PHPMailer();
					$mail->IsSMTP();
					$mail->SMTPAuth = true;
					$mail->Port = 587; 
					$mail->IsHTML(true); 
					$mail->CharSet = "utf-8";

					// VALORES A MODIFICAR //
					$mail->Host = $smtpHost; 
					$mail->Username = $smtpUsuario; 
					$mail->Password = $smtpClave;


					$mail->From = 'hresources@c0710238.ferozo.com'; // Email desde donde envío el correo.
					$mail->FromName = 'hResources';
					foreach($destinatarios as $email => $name){
   						$mail->AddAddress($email, $name);
					}
		
					
					$mail->Subject = "hResource - Alerta de Vencimientos inminentes"; // Este es el titulo del email.
					$mensajeHtml = nl2br($mensaje);
					$mail->Body = "{$mensajeHtml} <br/><br/>Diseñado y desarrollado por Main Group<br/>"; // Texto del email en formato HTML
					$mail->AltBody = "{$mensaje} \n\n Diseñado y desarrollado por Main Group"; // Texto sin formato HTML
					$estadoEnvio = $mail->Send(); 
					if($estadoEnvio){
					    echo "El correo fue enviado correctamente.";
					    foreach ($updater as $id) {
					    	$actualizacion = $mysqli->query("UPDATE contratos SET Enviado = 1 WHERE ID = '$id'");
					    }
					} else {
					    echo "Ocurrió un error inesperado.";
					}

			}
	}else{
		echo "Acción anulada por el servidor";
	}
$mysqli->close();
}


 ?>