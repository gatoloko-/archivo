<?php
	include "link/link.php";
	
	$numero = $_POST['numeroCaja'];
	$mes = $_POST['mesCaja'];
	$ano = $_POST['anoCaja'];
	$query = "CALL crear_caja(".$ano.",'".$mes."',".$numero.")";
	$query2 = "CALL caja_duplicada(".$ano.",'".$mes."',".$numero.")";
	
	if($mysqli){
		$mysqli->query($query2);
		if($mysqli->affected_rows<=0){
			include "link/link.php";
			if($mysqli->query($query)){
			echo "1";
			}else{
				echo "0";
			}
			
			
		}else{
			echo "2";
		}
		
	
		
	}
?>