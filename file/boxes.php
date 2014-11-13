<?php

include 'link/link.php';
$Month = $_POST['monthDropdown'];
$Year = $_POST['yearDropdown'];
$stringBoxes="";
$stringIds = "";

$consulta = "CALL boxes(".$Year.",'".$Month."')";
$resultado = $mysqli->query($consulta);
while($theBox=$resultado->fetch_assoc()){
	$stringIds=$stringIds.$theBox['id'].",";
}
echo substr($stringIds, 0, (strlen($stringIds)-1))."|";

include 'link/link.php';
$resultado = $mysqli->query($consulta);
while($theBox=$resultado->fetch_assoc()){
	$stringBoxes = $stringBoxes.$theBox['numero'].",";
}
echo substr($stringBoxes, 0, (strlen($stringBoxes)-1))."|";
?>