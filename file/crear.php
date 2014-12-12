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
	if($_SESSION['user_id']!=3){
		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">		
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->

		<title>SOCO - Crear</title>
		<?php the_header() ?>
		<meta name="description" content="">
		<meta name="author" content="MANAGER">
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		
		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
		
<script>
	$(function(){
		$("#box-creation").submit(submitFormCaja());
		$("#folder-creation").submit(submitFormFolder());
		$("#opsCreation").submit(submitFormOps());
	})
</script>
	</head>

	<body>
		<div>
			<header>
				<img src="logo.jpg" />
			</header>
			<?php nav() ?>

			<div>
				<a class="myButtons" onclick="showDialog('caja');">CAJA</a><br />
				<a class="myButtons" onclick="showDialog('carpeta');">CARPETA</a><br />
				
			</div>

			<footer>
				<p>
					&copy; Copyright  by MANAGER
				</p>
			</footer>
		</div>
		<div id="caja" title="Crear Caja">
			<form id="box-creation" name="box-creation" method="post" action="crear_caja.php">
				<table>
					<tr>
						<td>Ultima creada:</td>
						<td id="last-box">
							<?php  
								$ultima_caja = mysqli_fetch_row($mysqli->query("CALL ultima_caja()"));
								echo "Mes <strong style=\"color: red;\">"; 
								print $ultima_caja[2]." ";
								echo "</strong>Caja Nº <strong style=\"color: red;\">";
								print $ultima_caja[1]." ";
								echo "</strong>Año <strong style=\"color: red;\">";
								print $ultima_caja[0];
								echo "</strong>";
							?></strong>
						</td>
					</tr>
					<tr>
						<td>Año</td>
						<td><select name="anoCaja" id="anoCaja">
								<option></option>
								<option value="<?php echo date('Y')-1 ?>"><?php echo date('Y')-1 ?></option>
								<option value="<?php echo date('Y') ?>"><?php echo date('Y') ?></option>
								<option value="<?php echo date('Y')+1 ?>"><?php echo date('Y')+1 ?></option>
							</select>
							</td>
					</tr>
					<tr>
						<td>Mes</td>
						<td><select name="mesCaja" id="mesCaja">
								<option value="enero">enero</option>
								<option value="febrero">febrero</option>
								<option value="marzo">marzo</option>
								<option value="abril">abril</option>
								<option value="mayo">mayo</option>
								<option value="junio">junio</option>
								<option value="julio">julio</option>
								<option value="agosto">agosto</option>
								<option value="septiembre">septiembre</option>
								<option value="octubre">octubre</option>
								<option value="noviembre">noviembre</option>
								<option value="diciembre">diciembre</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Numero</td>
						<td>
							<select name="numeroCaja" id="numeroCaja">
								<?php 
									for($i=1; $i<=20; $i++){
										echo "<option value=\"".$i."\">".$i."</option>\n";
									}
								
								?>
							</select>
							
						</td>
					</tr>
					<tr>
						<td colspan="2"><button>Crear</button></td>
					</tr>
				</table>
			</form>
		</div>
		<div id="carpeta" title="Crear Carpeta">
			<form id="folderCreation" name="folderCreation" method="post" action="crear_carpeta.php">
				<table id="selector-caja">
					<tr>
						<td colspan="3">Seleccione la caja en la que desea crear la carpeta</td>
					</tr>
					<tr>
						<td>Año</td>
						<td> Mes</td>
						<td>Caja Nº</td>
					</tr>
					<tr>
						<td>
							<select name="yearDropdown" id="yearDropdown" onchange="getMonths();">
								<option value="0">Año</option>
								<?php
									include 'link/link.php';
									$consulta = "CALL years()";
									$resultado = $mysqli->query($consulta);
									
									while($theYear=$resultado->fetch_assoc()){
										echo '<option value="'.$theYear['ano'].'">'.$theYear['ano'].'</option>';
									}
								?>	
							</select>
						</td>
						<td id="month-selector"></td><td id="box-selector"></td>
					</tr>
					
				</table>
				
				<button>Crear carpeta</button>
			</form>
			<form id="opsCreation" name="opsCreation" action="crear_operaciones.php">
				<table id="selector-folder">
					<tr>
						<td colspan="4">Seleccione la carpeta en la que desea ingresar operaciones</td>
					</tr>
					<tr>
						
						<td>Carperta Nº</td>
					</tr>
					<tr>
						<td id="folder-selector"></td>
					</tr>
					
				</table>
				<table id="operaciones">
					<tr><td><strong>Opreraciones en la Carpeta</strong></td></tr>
					<tr><td><table id="opsInFolder"></table></td></tr>
					<tr><td><input id="codOperacion" name="codOperacion"/></td></tr>
				</table>
				<button>Agregar Operacion +</button>				
			</form>
		</div>
		<div id="operacion">
			
			
		</div>
	</body>
</html>
