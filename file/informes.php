<?php
	include_once 'link/link.php';
	include 'functions.php';
	include '../classes/Login.php';
	include '../mysql.php';
	$q = new dataBase;
	$L = new Login;
	if(!$L->isUserLoggedIn()){
		header('Location: /');
	}
	if($L->isUserLoggedIn()){
		echo '<div class="log">'.$_SESSION['user_name'].''."\r\n".'<br /><a class="link-close" href="/index.php?logout">Cerrar sesion</a> </div>';
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<?php the_header() ?>		
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<title>HTML</title>
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

			<div>
				<h1>Carpetas Prestadas</h1>
				<table>
					<tr bgcolor="#D9D9D9" >
						<th>Carpeta</th>
						<th>Operario</th>
					</tr>
					
				
				<?php
					include '/link/link.php';
					$queryUsers = 
					
					
					$query = "CALL carpetas_prestadas()";
					
					$resultado = $mysqli->query($query);
					while($theFolder=$resultado->fetch_assoc()){
						echo "<tr>
									<td>".$theFolder['id']."</td>
									<td>".$theFolder['nombre']."</td>
								</tr>";
						
					}
					
				?>
				</table>
				<h1>Historial</h1>
				<table class="CSSTableGenerator">
					<tr bgcolor="#D9D9D9">
						<td>Carpeta</td>
						<td>Usuario</td>
						<td>Administrador</td>
						<td>Transaccion</td>
						<td>Fecha</td>				
					</tr>
				<?php
					$historial = $q->query_table("historial", "ORDER BY fecha DESC LIMIT 50 ");
					foreach ($historial as $val){
						$user = $q->query_field_("users", "nombre", "user_id", $val['usuario']);
						$admin = $q->query_field_("users", "nombre", "user_id", $val['administrador']);
						echo "<tr>";
						echo "<td>".$val['carpeta']."</td>";
						foreach($user as $value){
							echo "<td>".$value['nombre']."</td>";
						}
						foreach($admin as $value){
							echo "<td>".$value['nombre']."</td>";
						}
						
						
						echo "<td>";
						if($val['transaccion']==1){
							echo "retiro";
						}elseif($val['transaccion']==0){
							echo "devolución";
						}elseif($val['transaccion']==2){
							echo "Retiro caja";
						}elseif($val['transaccion']==3){
							echo "Devolución caja";
						}
						echo "</td>";
						
						echo "<td>";
						echo $val['fecha'];
						echo "</td>";
						
						echo "</tr>";
						
					}
						
				 ?>
				</table>
			</div>

			<footer>
				<p>
					&copy; Copyright  by MANAGER
				</p>
			</footer>
		</div>
	</body>
</html>
