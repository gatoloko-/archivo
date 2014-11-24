<?php
session_start();
include 'link/link.php';

$carpeta = $_POST['idFolder'];
$consulta = "CALL devolver(".$carpeta.")";

if($mysqli->query($consulta)){
	if($mysqli->affected_rows>0){
		echo "1";
	}
	include 'link/link.php';
	$mysqli->query("INSERT INTO historial(carpeta, usuario, administrador, transaccion) VALUES(".$carpeta.", ".$_SESSION['user_id'].", ".$_SESSION['user_id'].", 3)");
}else{
	echo "shit!";
}

/*
$resultado = $mysqli->query($consulta);
while($theFolder=$resultado->fetch_assoc()){
	$stringIds=$stringIds.$theFolder['id'].",";
}
echo substr($stringIds, 0, (strlen($stringIds)-1));
*/
?>