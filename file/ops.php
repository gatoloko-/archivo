<?php

$folder=$_POST['folderDropdown'];
if($folder!=""){
	include "link/link.php";
	$query2 = "CALL operations(".$folder.")";
	$stringOps = "";
	if($mysqli){
		$resultado = $mysqli->query($query2);
		while($theOp=$resultado->fetch_assoc()){
			$stringOps = $stringOps.$theOp['numero'].",";
		}
		echo substr($stringOps, 0, (strlen($stringOps)-1));
		}
}

	
?>