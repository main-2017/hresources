<?php 

$mensaje = ;
$cabecera = "Cc: info@hresources.com, info@maingroup.com";
$cabecera.= "MIME-Version: 1.0rn";
$cabecera.= "Content-type: text/html; charset=utf-8";

if(mail("mail@hresources.com", "asunto", $mensaje, $cabecera)){

	echo "Mensaje enviado correctamente";

} else {

	echo "Error al enviar el mensaje";
}




 ?>