<?php 
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
require 'conexion.php';
session_start();
$mysqli->set_charset('utf8');
$resultado = $mysqli->query("SELECT * FROM contratos WHERE Fecha_Fin ORDER BY Fecha_Fin");
$fila = $mysqli->real_escape_string(mysqli_num_rows($resultado));
$salida = " ";
$objDate = new DateTime("now");
$today = strtotime($objDate->format('Y-m-d'));
$fechaC = "";
$salida.="<table class='table'><thead style='background-color:#337ab7; color:#FFF;'><tr><td>ID</td><td>CC</td><td>Fecha Inicio</td><td>Fecha Fin</td><td>Tipo</td></tr></thead><tbody>";
	while ($fila = $resultado->fetch_assoc()) {
		$salida.= "<tr>
					<td>".$fila['ID']."</td>
					<td>".$fila['CC']."</td>
					<td>".$fila['Fecha_inicio']."</td>
					<td>".$fila['Fecha_Fin']."</td>
					<td>".$fila['Tipo']."</td>";
					
					$fechaC = strtotime($fila['Fecha_Fin']);
					$interval =  $fechaC - $today;
					if($interval < 2592000 && $interval > 0){
						$salida.="<td style='background-color:red; color: #fff;'>-30 días</td></tr>";
					}else if($interval < 0){
						$salida.="<td style='background-color:grey; color: #fff;'>Vencido</td></tr>";
						
					}else{
						$salida.="</tr>";
					}
					
	}

	$salida.="</tbody></table>";
	echo $salida;
	
}

$mysqli->close();
 ?>