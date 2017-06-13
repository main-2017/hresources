<!-- Módulo para el ingreso y registro de nuevos empleados -->
 <?php 
 if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require 'conexion.php';
	session_start();
	$mysqli->set_charset('utf8');
	$cc = $mysqli->real_escape_string($_POST['cc']);
	$nombre = $mysqli->real_escape_string($_POST['nombre']);
	$apellido = $mysqli->real_escape_string($_POST['apellido']);
	$telefono = $mysqli->real_escape_string($_POST['telefono']);
	$celular = $mysqli->real_escape_string($_POST['celular']);
	$domicilio = $mysqli->real_escape_string($_POST['domicilio']);
	$nacionalidad = $mysqli->real_escape_string($_POST['nacionalidad']);
	$sexo = $mysqli->real_escape_string($_POST['sexo']);
	$estado = $mysqli->real_escape_string($_POST['estado']);

	$ingreso = $mysqli->query("INSERT INTO empleados(CC, Nombre, Apellido, Telefono, Celular, Domicilio, Nacionalidad, Sexo, Estado) VALUES('".$cc."', '".$nombre."', '".$apellido."', '".$telefono."', '".$celular."', '".$domicilio."', '".$nacionalidad."', '".$sexo."', '".$estado."');");
 }

 if ($ingreso) {
 	echo json_encode(array('error' => false));
 }else{
 	echo json_encode(array('error' => true));
 }
$mysqli->close();
 ?>