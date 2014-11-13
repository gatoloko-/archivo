<?php




function the_header(){
	echo "	<script type='text/javascript' src='jquery-ui/external/jquery/jquery.js'></script>
			<script type='text/javascript' src='jquery-ui/jquery-ui.js'></script>
			<link href='http://fonts.googleapis.com/css?family=Muli:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
			<link rel='stylesheet' type='text/css' href='style.css'>
			<script type='text/javascript' src='jq.js'></script>
			<link rel='stylesheet' type='text/css' href='jquery-ui/jquery-ui.css' />
			
			";
	
}
function nav(){
	
	
	echo '<nav>
				<div class="nav-item">
					<a href="/">Home</a>
				</div>
				<div class="nav-item">
					<a href="consultar.php">Consultar</a>
				</div>';
	if($_SESSION['user_id']==3 or $_SESSION['user_id']==4){
		
		echo	'<div class="nav-item">
					<a href="crear.php">Crear</a>
				</div>';
	}
				
		echo '<div class="nav-item">
					<a href="informes.php">Informes</a>
				</div>
				<div class="nav-item">
					<a href="../register.php">Registrar Usuarios</a>
				</div>
			</nav>';
}

function listarUsuarios(){
	include 'link/link.php';
	
	$consulta = "CALL listado_usuarios()";
	$resultado = $mysqli->query($consulta);
	
	while($usuario=$resultado->fetch_assoc()){
		echo "<option value='".$usuario['user_id']."'>".$usuario['nombre']."</option>";
	}
}
?>