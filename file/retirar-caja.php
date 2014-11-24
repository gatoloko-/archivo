<?php
	session_start();
	include 'link/link.php';
	$ano=$_POST['ano'];
	$mes=$_POST['mes'];
	$numero=$_POST['numero'];
	$idCaja = "";
	$queryCaja = "SELECT id FROM caja WHERE ano=".$ano." AND mes='".$mes."' AND numero=".$numero;
	$resultado = $mysqli->query($queryCaja);
	while($theId = $resultado->fetch_assoc()){
		$idCaja = $theId['id'];
	}
	
	   
	$query = "UPDATE carpeta SET estado=2, usuario=".$_SESSION['user_id']." WHERE caja=".$idCaja." AND (estado= 0 OR estado=NULL)";
   	$update = $mysqli->query($query);
	if($update){
		include 'link/link.php';
		$mysqli->query("INSERT INTO historial(carpeta, usuario, administrador, transaccion) VALUES(".$idCaja.", ".$_SESSION['user_id'].", ".$_SESSION['user_id'].", 2)");
		echo "La caja se ha retirado";
	}
?>