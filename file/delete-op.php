<?php
	include "link/link.php";
	
	$numero = $_POST['op'];
	$query2 = "DELETE FROM operacion WHERE numero = '".$numero."'";
	$query = "CALL borrar-operacion('".$numero."')";

	
	if($mysqli){
		
		if($mysqli->query($query2)){
			echo "1";
		}
	}else{
		echo "0";
	}
?>