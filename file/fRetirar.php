<?php
session_start();
include 'link/link.php';
$carpeta = $_POST['idFolder'];
$usuario = $_POST['idUser'];
$consulta = "CALL retirar(".$usuario.", ".$carpeta.")";

if($mysqli->query($consulta)){
	echo "1";
	include 'link/link.php';
	$mysqli->query("INSERT INTO historial(carpeta, usuario, administrador, transaccion) VALUES(".$carpeta.", ".$usuario.", ".$_SESSION['user_id'].", 1)");
}else{
	echo "shit!";
}


?>