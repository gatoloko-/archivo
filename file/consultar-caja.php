<?php
include 'link/link.php';
$idCaja = "";
$total= "";
$ano = $_POST['ano'];
$mes = $_POST['mes'];
$caja = $_POST['numero'];
$query = "SELECT COUNT(*) FROM carpeta WHERE caja=(SELECT id FROM caja WHERE ano='".$ano."' AND mes='".$mes."' AND numero='".$caja.")";

if($resultado = $mysqli->query($query)){
	$total = $resultado->fetch_array(MYSQLI_ASSOC);
	printf("%s", $resultado['id'] );
	
}
?>