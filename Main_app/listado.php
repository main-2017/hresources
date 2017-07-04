<?php 
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require'conexion.php';
	$query = " SELECT * FROM empleados WHERE NOT EXISTS (SELECT 1 FROM contratos WHERE contratos.CC = empleados.CC)";
	$resultado = $mysqli->query($query);
	$fila = mysqli_num_rows($resultado);
	$salida=" ";

	if($fila > 0){
		while($fila = $resultado->fetch_assoc()){
			$salida.="<option value='".$fila['CC']."'label=".$fila['Nombre']. "&nbsp;".$fila['Apellido']."&nbsp;".$fila['CC'].">";
		}
	} else {
		$salida="No hay datos";
	}
	
	echo $salida;
}
	$mysqli->close();

 ?>