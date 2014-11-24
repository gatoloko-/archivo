<?php
include '../classes/Login.php';
include 'link/link.php';
session_start();


$Op = $_POST['codigoOperacion'];
$consultaOp = "CALL operacion('".$Op."')";
$resultadoOp = $mysqli->query($consultaOp);
$theOperation="";
$carpeta ="";
$operacion["id"]= $Op; 
$theOperation=$resultadoOp->fetch_assoc();
	$carpeta = $theOperation['carpeta'];
	$operacion['carpeta']=$carpeta;

if($operacion['carpeta']!=""){
	
	include 'link/link.php';
	$consultaFolder = "CALL carpeta(".$carpeta.")";
	$resultadoFolder = $mysqli->query($consultaFolder);
	$theFolder="";
	$caja ="";
	$theFolder=$resultadoFolder->fetch_assoc();
	$caja = $theFolder['caja'];
	$estado = $theFolder['estado'];
	$usuario = $theFolder['usuario'];
	$operacion['caja']= $caja;
	$operacion['estado']= $estado;
	if($usuario!=""){
		
		include 'link/link.php';
		$consultaUser = "CALL usuario(".$usuario.")";
		$resultadoUser = $mysqli->query($consultaUser);
		$theUser ="";
		$theUser=$resultadoUser->fetch_assoc();
		$operacion['idUsuario']=$theUser['user_id'];
		$operacion['nombre']=$theUser['nombre'];
		
	}else{
		$operacion['usuario']= "0";
	}

	
	
	include 'link/link.php';
	$consultaBox = "CALL caja(".$caja.")";
	$resultadoBox = $mysqli->query($consultaBox);
	$theBox ="";
	$theBox=$resultadoBox->fetch_assoc();
	$operacion['ano']=$theBox['ano'];
	$operacion['mes']=$theBox['mes'];
	$operacion['numero']=$theBox['numero'];
	
	
	
	echo "1,";
	echo $operacion['id'].",";
	echo $operacion['carpeta'].",";
	echo $operacion['caja'].",";
	echo $operacion['ano'].",";
	echo $operacion['mes'].",";
	echo $operacion['numero'].",";
	echo $operacion['estado'].",";
	if($operacion['estado']==1 or $operacion['estado']==2){
		echo $operacion['idUsuario'].",";
		echo $operacion['nombre'].",";
	}elseif($operacion['estado']==0){
		echo "0".",";
		echo "Archivo,";
	}
	echo $_SESSION['user_id'];
	
}else{
	echo "0";
}
?>