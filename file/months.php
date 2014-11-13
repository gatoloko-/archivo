<?php

include 'link/link.php';
$json = $_POST['yearDropdown'];
$ano = json_decode($json);
$consulta = "CALL months('".$ano."')";
$resultado = $mysqli->query($consulta);
$valores = "";
while($theYear=$resultado->fetch_assoc()){
	$valores = $valores.$theYear['mes'].',';
}
echo substr($valores, 0, (strlen($valores)-1));
?>