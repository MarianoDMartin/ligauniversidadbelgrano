<?php
session_start();
if ($_SESSION['usuario']=="")
    header("Location: ../index.html");
?>
<html>
<head>
	<title>Administracion</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<link rel="stylesheet" type="text/css" href="../css/administracion.css">
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
</head>
<body class="paginas-internas">
	<section class="bienvenidos">
		<header class="navbar fixed-top encabezado">
			<div class="container">
				<div class="administracion">
					<h1>Administración - LigaUB</h1>
				</div>
				<button type"button" class="boton-menu d-md-none" data-toggle="collapse" data-target="#menu-principal" aria-expanded="false" aria-controls="collapseExample">
					<i class="fa fa-bars" aria-hidden="true"></i>
				</button>
				<nav id="menu-principal" class="collapse">
					<ul>
						<li><a href="./inscriptos.php">Inscriptos</a></li>
						<li><a href="./torneo.php">Torneo</a></li>
						<li class="active"><a href="./resultados.php">Resultados</a></li>
						<li><a href="../php/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
				</button></a></li>
					</ul>
				</nav>
			</div>
		</header>
		<div class="texto-encabezado text-center">
			<div class="container">
				<h1 class="display-4">Resultados</h1>
				<p>Administración de los Resultados de los Partidos</p>
			</div>
		</div>
	</section>
	<section class="ruta py-3"">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-sm-right">
                    Resultados
                </div>
            </div>
        </div>
    </section>
	<main class="py-3 medio">
		<div class="container">
			<div class="row">
				<div class="col-md-12 padding-top">
				<?php
					$con = mysqli_connect('universys.site', 'apholos_dba', 'dbainub', 'apholos_ligaub');
					if (mysqli_connect_errno())
					{
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
					}

					$result = mysqli_query($con,   "SELECT p.id_partido, 
													part1.nombre as nombre1, 
													part1.apellido as apellido1, 
													part2.nombre as nombre2, 
													part2.apellido as apellido2,
													p.id_participante1,
													p.id_participante2, 
													f.fecha,h.horario
													from 	Partidos p,
															horarios h,
															fechas_disponibles f,
															Participantes part1,
															Participantes part2
													where p.id_participante1	=	part1.id_inscripto
													and p.id_participante2	=	part2.id_inscripto
													and p.fecha	=	f.id_fecha
													and p.hora	=	h.id_horario
													and p.goles1 is null
													order by f.fecha,h.horario");
					$rows=mysqli_affected_rows($con);
					if ($rows>0){
						$ronda = mysqli_query($con, "SELECT ronda from Partidos order by ronda desc limit 1");
						$row = mysqli_fetch_array($ronda);
						echo '<h1>Partidos Pendientes Ronda ' . $row['ronda'] . '</h1>';
						?>
						<div class="table-responsive">
							<table class="table table-condensed table-hover table-striped" width="60%" cellspacing="0">
								<thead>
									<tr>
										<th>#Partido</th>
										<th>Participante1</th>
										<th>Participante2</th>
										<th>Fecha</th>
										<th>Hora</th>
										<th>Goles Particip1</th>
										<th colspan="2">Goles Particip2</th>
									</tr>
								</thead>
								<tbody id="tabla_participantes">

									<?php
									while($row = mysqli_fetch_array($result))
									{
										echo '<form name="resultado" action="php/cargarResultado.php" runat="server" onsubmit="return validar(this);" method="POST">';
										echo "<tr>";
										echo '<td> <label>' . $row['id_partido'] . '</label> </td>';
										echo '<td> <label>' . $row['nombre1'] . " " . $row['apellido1'] . '</label> </td>';
										echo '<td> <label>' . $row['nombre2'] . " " . $row['apellido2'] . '</label> </td>';
										echo '<td> <label>' . $row['fecha'] . '</label> </td>';
										echo '<td> <label>' . $row['horario'] . '</label> </td>';
										echo '<td> <input type="number" min="0" size="2" name="goles1" required></td>';
										echo '<td> <input type="number" min="0" size="2" name="goles2" required></td>';
										echo '<input hidden type="text" name="id_partido" value="' . $row['id_partido'] . '">';
										echo '<input hidden type="text" name="id_participante1" value="' . $row['id_participante1'] . '">';
										echo '<input hidden type="text" name="id_participante2" value="' . $row['id_participante2'] . '">';
										echo '<td> <button name="penviar" type="submit" class="btn-enviar" id="penviar">';
										echo '<i class="fa fa-check" aria-hidden="true"></i>';
										echo "</button></td>";
										echo "</tr>";
										echo "</form>";
									}
									mysqli_close($con);
									?>
								</tbody>
							</table>
						</div>
					<?php
					}else{
						echo "<h2>No tenés resultados pendientes para cargar! FELICITACIONES!!!</h2>";
						echo "<h2>Ya podés generar la próxima Ronda en la sección <a href='torneo.php'>Torneo</a></h2>";
					}	
				?>
			</div>
		</div>
	</main>
	<footer class="pieAdministracion" role="contentinfo">
        <div class="container">
            <p>2017 - Universys Facultad de Tecnología UB </br>Todos los derechos reservados</p>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="../js/jquery-3.2.1.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
<script type="text/javascript">
	function validar(form){
		if(form.goles1.value==form.goles2.value){
			alert('No se admiten empates, verifique los resultados.')
			return false;
		}
		return true;
	}
</script>
</html>