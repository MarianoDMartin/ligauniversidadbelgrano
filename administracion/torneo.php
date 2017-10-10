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
						<li class="active"><a href="./torneo.php">Torneo</a></li>
						<li><a href="./resultados.php">Resultados</a></li>
						<li><a href="../php/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
				</button></a></li>
					</ul>
				</nav>
			</div>
		</header>
		<div class="texto-encabezado text-center">
			<div class="container">
				<h1 class="display-4">Torneo</h1>
				<p>Administración de las rondas del torneo</p>
			</div>
		</div>
	</section>
	<section class="ruta py-3"">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-sm-right">
                    Torneo
                </div>
            </div>
        </div>
    </section>
	<main class="py-3 medio">
		<div class="container">
			<div class="row">
				<?php
					$con = mysqli_connect('universys.site', 'apholos_dba', 'dbainub', 'apholos_ligaub');
					if (mysqli_connect_errno()){
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
					}
					$partidosPendientes = mysqli_query($con,   "SELECT p.id_partido, 
																part1.nombre as nombre1, 
																part1.apellido as apellido1, 
																part2.nombre as nombre2, 
																part2.apellido as apellido2,
																f.fecha,
																h.horario,
																p.fecha as id_fecha,
																p.hora as id_hora,
																p.flag_error
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
					$ronda = mysqli_query($con, "SELECT ronda from Partidos order by ronda desc limit 1");
					$nronda = mysqli_fetch_array($ronda);
					if ($rows>0){
						echo '<div class="col-md-12 padding-top">';
						echo '<h1>Partidos Pendientes Ronda ' . $nronda['ronda'] . '</h1>';
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
									</tr>
								</thead>
								<tbody id="tabla_participantes">

									<?php
									while($row = mysqli_fetch_array($partidosPendientes))
									{
										echo '<form name="resultado" action="php/updatePartido.php" runat="server" method="POST">';
										echo "<tr>";
										echo '<td> <label>' . $row['id_partido'] . '</label> </td>';
										echo '<td> <label>' . $row['nombre1'] . " " . $row['apellido1'] . '</label> </td>';
										echo '<td> <label>' . $row['nombre2'] . " " . $row['apellido2'] . '</label> </td>';
										echo '<td><select class="form-control" name="fechas" id="fechas' . $row['id_partido'] . '" disabled>';
										$fechas = mysqli_query($con,"SELECT * FROM fechas_disponibles where ronda='" . $nronda['ronda'] ."' ORDER BY 2");
										while($fecha = mysqli_fetch_array($fechas))
										{
											if($fecha['id_fecha']==$row['id_fecha']){
												echo '<option value="' . $fecha['id_fecha'] . '" selected>' . $fecha['fecha'] . '</option>';
											}else{
												echo '<option value="' . $fecha['id_fecha'] . '">' . $fecha['fecha'] . '</option>';
											}
										}
										echo "</select></td>";
										echo '<td><select class="form-control" name="horarios" id="horarios' . $row['id_partido'] . '" disabled>';
										$horarios = mysqli_query($con,"SELECT * FROM horarios ORDER BY 2");
										while($horario = mysqli_fetch_array($horarios))
										{
											if($horario['id_horario']==$row['id_hora']){
												echo '<option value="' . $horario['id_horario'] . '" selected>' . $horario['horario'] . '</option>';
											}else{
												echo '<option value="' . $horario['id_horario'] . '">' . $horario['horario'] . '</option>';
											}
										}
										echo "</select></td>";
										
										
										echo '<td> <input hidden type="text" name="id_partido" value="' . $row['id_partido'] . '"></td>';
										echo '<td> <button type="button" name="editar"  class="btn-editar" value="' . $row['id_partido'] . '" id="editar' . $row['id_partido'] . '">';
										echo '<i class="fa fa-pencil" aria-hidden="true"></i>';
										echo "</button></td>";
										echo '<td> <button name="enviar" type="submit" class="btn-enviar" id="enviar' . $row['id_partido'] . '" hidden>';
										echo '<i class="fa fa-check" aria-hidden="true"></i>';
										echo "</button></td>";
										echo '<td> <button name="cancelar" type="button" class="btn-cancelar" id="cancelar' . $row['id_partido'] . '" hidden>';
										echo '<i class="fa fa-times" aria-hidden="true"></i>';
										echo "</button></td>";
										if($row['flag_error']){
											echo '<td><button type="button" name="error" class="btn-error">';
											echo '<i class="fa fa-exclamation" aria-hidden="true"></i>';
											echo "</button></td>";
										}
										echo "</tr>";
										echo "</form>";
									}
									?>
								</tbody>
							</table>
						</div>
						<?php
					}else{
						$numRonda= $nronda['ronda'];
						$numRonda++;

						$result = mysqli_query($con,"SELECT * FROM Participantes where fecha_hasta is null");
						$cantidadParticipantes=mysqli_affected_rows($con);

						if($cantidadParticipantes>1){
							echo '<div class="col-md-12 padding-top">';
							echo "<h1>Formulario para Generar Ronda " . $numRonda . "</h1>";
							
							echo '<form name="ronda" class="formRonda" action="./php/crearRonda.php" runat="server" method="POST" onsubmit="return validar(this,' . $cantidadParticipantes . ');">';
								echo '<input hidden type="text" name="ronda" value="' . $numRonda . '">';
							?>
								<div class="form-group row">
									<label for="consolas" class="col-md-2 col-form-label">Consolas disponibles</label> 
									<div class="col-md-2">
										<input class="form-control" type="number" min="1" name="consolas" id="consolas" required>
									</div>
								</div>
								<div class="form-group row" id="divFechas">
									<label for="fechas_disponibles" class="col-md-12 col-form-label">
									Fechas disponibles
										<button name="agregarFecha" type="button" class="btn-enviar" id="agregarFecha">
											<i class="fa fa-plus-circle" aria-hidden="true"></i>
										</button>
									</label> 
								</div>
								<div class="form-group row">
		                        	<div class="col-md-8 ml-md-4">
		                                <button type="submit" class="btn btn-primary">Generar</button>
		                        	</div>
		                    	</div>
							</form>
							<?php
						}else{
							echo "<h2>El Torneo está terminado! Gracias por utilizar el sistema!!!</h2>";
						}
					}
					mysqli_close($con);
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

	function validar(form,cantidadParticipantes){
		debugger;
		var cantidadConsolas=form.consolas.value;
		var fechasCargadas=document.getElementsByName("fechas[]");
		var cantidadFechasCargadas=fechasCargadas.length;
		var partidosNecesarios=parseInt(cantidadParticipantes/2);
		var cantidadFechasNecesarias=Math.ceil(partidosNecesarios/(5*cantidadConsolas));
		if(cantidadFechasCargadas<cantidadFechasNecesarias){
			alert('La cantidad mínima de fechas es ' + cantidadFechasNecesarias)
			return false;
		}
		return true;
	}

	function listener_edits() {
		var botonesEditar=document.getElementsByName("editar");
		for (var a=0; a<botonesEditar.length; a++){
			botonesEditar[a].onclick = function(){
				deshabilitar_campos_todos();
				habilitar_campos(this.value);
			}
		}
	}

	function listener_cancelar() {
		var botonesCancelar=document.getElementsByName("cancelar");
		for (var a=0; a<botonesCancelar.length; a++){
			botonesCancelar[a].onclick = function(){
				deshabilitar_campos_todos();
			}
		}
	}

	function listener_agregar_fecha() {
		var botonAgregarFecha=document.getElementById("agregarFecha");
		botonAgregarFecha.onclick=function(){
			crear_input();
		}
	}

	var cantidadFechas=0;

	function crear_input(){
		var divFecha=document.createElement("div");
		divFecha.setAttribute("class","col-md-3 padding-top");
		cantidadFechas++;
		divFecha.innerHTML='Fecha '+cantidadFechas+'<input class="form-control" type="date" name="fechas[]" required>';
		document.getElementById("divFechas").appendChild(divFecha);
	}

	function habilitar_campos(id){
		document.getElementById("editar"+id).hidden=true;
		document.getElementById("enviar"+id).hidden=false;
		document.getElementById("cancelar"+id).hidden=false;
		document.getElementById("fechas"+id).disabled=false;
		document.getElementById("horarios"+id).disabled=false;
	}

	function deshabilitar_campos_todos(){
		var botonesEditar=document.getElementsByName("editar");
		for (var a=0; a<botonesEditar.length; a++){
			deshabilitar_campos(botonesEditar[a].value);
		}
	}

	function deshabilitar_campos(id){
		document.getElementById("editar"+id).hidden=false;
		document.getElementById("enviar"+id).hidden=true;
		document.getElementById("cancelar"+id).hidden=true;
		document.getElementById("fechas"+id).disabled=true;
		document.getElementById("horarios"+id).disabled=true;
	}

	window.onload= function(){
		listener_edits();
		listener_cancelar();
		listener_agregar_fecha();
	}

</script>
</html>