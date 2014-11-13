<?php
	
	include "link/link.php";
	
	$caja = $_POST['boxDropdown'];
	
	$query = "CALL crear_carpeta(".$caja.")";
	
	if($mysqli){
	
		if($mysqli->query($query)){
			echo "1,";
			include "link/link.php";
			$ultimo_folder = mysqli_fetch_row($mysqli->query("CALL ultimo_folder()")); 
			print $ultimo_folder[0]." ";
		}else{
			echo "0";
		}
	}	
	
?>