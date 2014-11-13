<?php

include 'link/link.php';
$box = $_POST['boxDropdown'];
$stringfolders="";
$stringIds = "";

if(!$box==""){
	$consulta = "CALL folders(".$box.")";
	$resultado = $mysqli->query($consulta);
	while($theFolder=$resultado->fetch_assoc()){
		$stringIds=$stringIds.$theFolder['id'].",";
	}
	echo substr($stringIds, 0, (strlen($stringIds)-1));
}


?>