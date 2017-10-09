<!DOCTYPE html>
<html>
<head>
	<title>Inscripcion - Liga Universidad de Belgrano</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
</head>
<body class="paginas-internas">
	<section class="bienvenidos">
		<header class="navbar fixed-top encabezado">
			<div class="container">
				<a href="index.html">
					<img id="logo" src="img/liga.png">
				</a>
				<button type"button" class="boton-menu d-md-none" data-toggle="collapse" data-target="#menu-principal" aria-expanded="false" aria-controls="collapseExample">
					<i class="fa fa-bars" aria-hidden="true"></i>
				</button>
				<nav id="menu-principal" class="collapse">
					<ul>
						<li><a href="./index.html">Inicio</a></li>
						<li class="active"><a href="./torneo.php">Torneo</a></li>
						<li><a href="./soporte.html">Soporte</a></li>
						<li><a href="./academica.html">Información Académica</a></li>
					</ul>
				</nav>
			</div>
		</header>
		<div class="texto-encabezado text-center">
			<div class="container">
				<h1 class="display-4">Torneo</h1>
				<p>Mirá los resultados y cronograma de todos los partidos!!!</p>
			</div>
		</div>
	</section>
	<section class="ruta py-3"">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-sm-right">
                    <a href="index.html">Inicio</a> » Torneo
                </div>
            </div>
        </div>
    </section>
	<main class="py-3">
		<div class="container">
			<div class="row">
				<?php
				$con = mysqli_connect('universys.site', 'apholos_dba', 'dbainub', 'apholos_ligaub');
				if (mysqli_connect_errno()){
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
				}
				$ronda = mysqli_query($con, "SELECT ronda from Partidos order by ronda desc limit 1");
				$nronda = mysqli_fetch_array($ronda);
				$numRonda= $nronda['ronda'];
				for ($i=1; $i <=$numRonda ; $i++) {
					echo '<div class="col-md-6 ronda border">';
					echo "<h1>Ronda " . $i . "</h1>";
					$ronda = mysqli_query($con, 	"SELECT p.id_partido, 
													part1.nombre as nombre1, 
													part1.apellido as apellido1, 
													part2.nombre as nombre2, 
													part2.apellido as apellido2,
													f.fecha,
													h.horario,
													p.goles1,
													p.goles2
													from 	Partidos p,
															horarios h,
															fechas_disponibles f,
															Participantes part1,
															Participantes part2
													where p.id_participante1	=	part1.id_inscripto
													and p.id_participante2	=	part2.id_inscripto
													and p.fecha	=	f.id_fecha
													and p.hora	=	h.id_horario
													and p.ronda='" . $i . "'
													order by f.fecha,h.horario");
					while($partido = mysqli_fetch_array($ronda))
					{	
						if($partido['goles1'] or $partido['goles1']=='0'){
							echo '<div class="partido col-md-12 jugado">';
						}
						else{
							echo '<div class="partido col-md-12 pendiente">';
						}
						echo '<h3>Partido #' . $partido['id_partido'] . '</h3>';
						echo '<h3>' . $partido['nombre1'] . ' ' . $partido['apellido1'] . ' VS ' . $partido['nombre2'] . ' ' . $partido['apellido2'] . '</h3>';
						if($partido['goles1'] or $partido['goles1']=='0'){
							echo '<h3>' . $partido['goles1'] . '    :    ' . $partido['goles2'] . '</h3>';
						}
						else{
							echo $partido['fecha'] . ' a las ' . $partido['horario'] . '</br>';
						}
						echo '</div>';
					}
					echo '</div>';
				}




				mysqli_close($con);
				?>
			</div>
		</div>
	</main>
	<footer class="piedepagina py-3"" role="contentinfo">
        <div class="container">
            <p>2017 - Universys Facultad de Tecnología UB </br>Todos los derechos reservados</p>
        </div>
    </footer>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>