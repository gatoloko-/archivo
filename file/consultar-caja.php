<?php
include 'link/link.php';
$Month = $_POST['mes'];
$Year = $_POST['ano'];
$Box = $_POST['numero'];
$array = "";
$Total = array();
$consulta = "SELECT id FROM caja WHERE ano=".$Year." AND mes='".$Month."' AND numero=".$Box;
$resultado = $mysqli->query($consulta);
while($theBox=$resultado->fetch_assoc()){
	$array = $theBox['id'];
}


include 'link/link.php';
$consulta2 = "SELECT * FROM carpeta WHERE caja=".$array;

if($resultado2 = $mysqli->query($consulta2)){
	while($theCount=$resultado2->fetch_assoc()){
	array_push($Total, $theCount);
}
	echo "La caja ".$Box." de ".$Month." contiene ".count($Total)." carpeta(s).<br/>";
	echo "<ul class='folder'>";
	foreach($Total as $val){
		echo "<li>".$val['id']."</li>";
	}
	echo "</ul>";
}else{
	echo "<span>Caja no encontrada.</span>";
}


?>	