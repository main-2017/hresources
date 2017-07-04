<!-- Carga en ventana modal de formulario dinámico para modificación de contratos -->
<?php 
 if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require 'conexion.php';
	session_start();
	$mysqli->set_charset('utf8');
	$searchID = $mysqli->real_escape_string($_POST['input']);
	$query = $mysqli->query("SELECT * FROM contratos WHERE ID = '$searchID'");
	$salida= '';
	if ($query->mysqli_num_rows = 1) {
		$array = $query->fetch_assoc();
		$salida.= "<div class='form-group'>
						<label class='text-muted' for='id'>ID de Contrato</label>
						<input type='number' name='id' class='form-control' id='id' value='".$array['ID']."'>
					</div>
					<div class='form-group'>
						<label class='text-muted' for='cc'>CC de Empleado</label>
						<input type='number' name='cc' class='form-control' id='cc' pattern='[0-9]{8,10}' value='".$array['CC']."'>
					</div>
					<div class='form-group'>
						<label class='text-muted' for='fechaInicio'>Fecha de Inicio</label>
						<input type='date' name='fechaInicio' class='form-control' id='fechaInicio' value='".$array['Fecha_inicio']."'>
					</div>
					<div class='form-group'>
						<label class='text-muted' for='fechaFin'>Fecha de Finalización</label>
						<input type='date' name='fechaFin' class='form-control' id='fechaFin' value='".$array['Fecha_Fin']."'>
					</div>";
					
					$salida.= "<br>
								<h5 class='text-muted text-center'>Tipo</h5>";
						
					if ($array['Tipo'] == 'Temporal 3 meses') {
						$salida.="<select class='form-control' name='tipo'>
									<option value='Temporal 3 meses'>Temporal 3 meses</option>
									<option value='Temporal 1 año'>Temporal 1 año</option>
									<option value='Indefinido'>Indefinido</option>
								</select>";
					}elseif ($array['Tipo'] == 'Temporal 1 año') {
						$salida.="<select class='form-control' name='tipo'>
									<option value='Temporal 1 año'>Temporal 1 año</option>
									<option value='Temporal 3 meses'>Temporal 3 meses</option>
									<option value='Indefinido'>Indefinido</option>
								</select>";
					}elseif ($array['Tipo'] == 'Indefinido') {
						$salida.= "<select class='form-control' name='tipo'>
									<option value='Indefinido'>Indefinido</option>
									<option value='Temporal 1 año'>Temporal 1 año</option>
									<option value='Temporal 3 meses'>Temporal 3 meses</option>
								</select>";
					}

					$salida.="<br>
								<h5 class='text-muted text-center'>Alerta de finalización de contrato</h5>";

					if ((strtotime($array['Fecha_Fin']) - (strtotime($array['Alerta1']))) == 2592000) {
									
					$salida.="<select class='form-control' name='Alerta'>
									<option value='2592000'>30 días antes</option>
									<option value='864000'>10 días antes</option>
									<option value='172800'>2 días antes</option>
								</select>";
					}elseif ((strtotime($array['Fecha_Fin']) - (strtotime($array['Alerta1']))) == 864000) {
						$salida.="<select class='form-control' name='Alerta'>
									<option value='864000'>10 días antes</option>
									<option value='2592000'>30 días antes</option>
									<option value='172800'>2 días antes</option>
								</select>";
					}else{
						$salida.="<select class='form-control' name='Alerta'>
									<option value='172800'>2 días antes</option>
									<option value='2592000'>30 días antes</option>
									<option value='864000'>10 días antes</option>
								</select>";
					}

										
			}else{
				$salida = "No hay datos para mostrar";
				
			}
				echo $salida;				

	}
$mysqli->close();


 ?>