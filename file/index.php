<?php
	include_once 'link/link.php';
	include 'functions.php';
	include '../classes/Login.php';
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
		
		<title>SOCO - Home</title>
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
				<img src="logo.jpg" />
			</header>
			<?php nav() ?>

			<div>

			</div>

			<footer>
				<p>
					&copy; Copyright  by MANAGER
				</p>
			</footer>
		</div>
	</body>
</html>
