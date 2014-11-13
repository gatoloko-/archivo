<?php
	$operacion = $_POST['codOperacion'];
	$folder = $_POST['folderDropdown'];
	
	include "link/link.php";
	$query2 = "CALL operacion_dup('".$operacion."')";
	
	if($mysqli){
	
		if($mysqli->query($query2)){
			if($mysqli->affected_rows>=1){
				
				include "link/link.php";
				$resultado = $mysqli->query($query2);
				while($theFolder=$resultado->fetch_assoc()){
						echo "2,";
						echo $theFolder['carpeta'].",";
						echo $operacion.",";
				}
				
				
			}
		}else{
			echo "0";
		}
	}
	
	include "link/link.php";
	
	$query = "CALL crear_operacion('".$operacion."', ".$folder.")";
	
	if($mysqli){
	
		if($mysqli->query($query)){
			echo "1,";
			echo $operacion.",";
			echo $folder;
		}else{
			echo "0";
		}
	}
	
?>