<?php
	include 'link/link.php';
	include 'functions.php';
	include '../classes/Login.php';
	$L = new Login;
	if(!$L->isUserLoggedIn()){
		header('Location: .../');
	}
	if($L->isUserLoggedIn()){
		echo '<div class="log">'.$_SESSION['user_name'].''."\r\n".'<br /><a class="link-close" href="/index.php?logout">Cerrar sesion</a> </div>';
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">		
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->

		<title>Consultas</title>
		<?php the_header() ?>
		<meta name="description" content="">
		<meta name="author" content="MANAGER">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
		
	
		
	</head>

	<body>
		<div>
			<header>
				<h1>Sistema de gestion de carpetas</h1>
			</header>
			<?php nav() ?>
			
			<a class="myButtons" onclick="showDialog('consultarOp');">Consultar operacion</a>
			
			<footer>
				<p>
					&copy; Copyright  by MANAGER
				</p>
			</footer>
		</div>
<!-- =========================================== MODALS ======================================================== -->
<div id="consultarOp" title="Consultar operaciones">
	<table>
		<tr>
			<td><input id="codigoOperacion" width="5"/><button onclick="submitOpsSearch();">Consultar</button></td>
		</tr>
		<tr><td><select id="dropUsers" hidden><?php listarUsuarios(); ?></select></td></tr>
		<tr id="opTable"></tr>
	</table>
	
</div>
<!-- =========================================== MODALS ======================================================== -->
	</body>
</html>
