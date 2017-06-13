<?php 
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require'conexion.php';
	$query = "SELECT CC, Nombre, Apellido FROM empleados ORDER BY CC";
	$resultado = $mysqli->query($query);
	$fila = mysqli_num_rows($resultado);
	$salida=" ";
	$salida.= "<datalist id='sugest-cc'>";

	if($fila > 0){
		while($fila = $resultado->fetch_assoc()){
			$salida.="<option value='".$fila['CC']."'label=".$fila['Nombre']. "&nbsp;".$fila['Apellido'].">";
		}
	} else {
		$salida="No hay datos";
	}
	$salida.="</datalist>";
	echo $salida;
}
	$mysqli->close();

 ?>