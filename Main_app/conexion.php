<?php 
	// Conexión de base de datos local:
	 $mysqli = new mysqli('localhost', 'root', '', 'hresourcesDB');
	 if ($mysqli->connect_errno):
	 	echo "Error al conectarse con MySQL debido al error" . $mysqli->connect_error;
	 endif;

// Conexión a servidor SafeTics
//$mysqli = new mysqli('localhost', 'pruebas_main', 'VSCV.8.07.1988', 'pruebas_hresources');
//	if ($mysqli->connect_errno):
//		echo "Error al conectarse con MySQL debido al error" . $mysqli->connect_error;
//	endif;
 //

 ?>