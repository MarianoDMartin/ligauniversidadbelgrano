<?php
session_start();
if ($_SESSION['usuario']=="")
    echo "<script language='javascript'>
	alert('ERROR: No tiene permisos para acceder a esta página');
	window.location.href = 'usuario.html';
	</script>";
?>
<html>
<head>
	<title>Liga Universidad de Belgrano</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="./css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<header class="vertical-centered-text">
			<div class="logo">
				<img id="joystick" src="../img/joystick.png">
				<h1>Liga Universidad de Belgrano</h1>
			</div>
		</header>
		<main>
			<img id="construccion" src="./img/construccion.jpg">
		</main>
		<footer>
			
		</footer>
	</div>
</body>
</html>