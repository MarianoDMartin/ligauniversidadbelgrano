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
						<li class="active"><a href="./inscriptos.php">Inscriptos</a></li>
						<li><a href="./torneo.php">Torneo</a></li>
						<li><a href="./resultados.php">Resultados</a></li>
						<li><a href="../php/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
				</button></a></li>
					</ul>
				</nav>
			</div>
		</header>
		<div class="texto-encabezado text-center">
			<div class="container">
				<h1 class="display-4">Inscriptos</h1>
				<p>Administración de los participantes y ayudantes inscriptos al Torneo</p>
			</div>
		</div>
	</section>
	<section class="ruta py-3"">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-sm-right">
                    Inscriptos
                </div>
            </div>
        </div>
    </section>
	<main class="py-3 medio">
		<div class="container">
			<div class="row">
				<div class="col-md-12 padding-top">
					<h1>Participantes</h1>
					<div class="table-responsive">
						<table class="table table-condensed table-hover table-striped" width="60%" cellspacing="0">
							<thead>
								<tr>
									<th>Id</th>
									<th>Documento</th>
									<th>Nombre</th>
									<th>Apellido</th>
									<th>Email</th>
									<th>Telefono</th>
									<th>Disp.</th>
									<th>Equipo</th>
									<th colspan="3"></th>
								</tr>
							</thead>
							<tbody id="tabla_participantes">
								<?php
									$con = mysqli_connect('universys.site', 'apholos_dba', 'dbainub', 'apholos_ligaub');
									if (mysqli_connect_errno())
									{
									echo "Failed to connect to MySQL: " . mysqli_connect_error();
									}

									$result = mysqli_query($con,"SELECT * FROM Participantes where fecha_hasta is null");

									while($row = mysqli_fetch_array($result))
									{	
										echo '<form name="participante" class="" action="php/updateParticipante.php" runat="server" method="POST">';
										echo "<tr>";
										echo '<td> <input disabled  readonly="readonly" type="text" size="3" name="idParticipante" id="pid' . $row['id_inscripto'] . '" value="'      . $row['id_inscripto']      . '"></td>';
										echo '<td> <input disabled type="text" size="12" name="documento" id="pdocumento' . $row['id_inscripto'] . '" value="'      . $row['documento']      . '"></td>';
										echo '<td> <input disabled type="text" size="12" name="nombre" id="pnombre' . $row['id_inscripto'] . '" value="'         . $row['nombre']         . '"></td>';
										echo '<td> <input disabled type="text" size="12" name="apellido" id="papellido' . $row['id_inscripto'] . '" value="'       . $row['apellido']       . '"></td>';
										echo '<td> <input disabled type="text" size="30" name="email" id="pemail' . $row['id_inscripto'] . '" value="'          . $row['email']          . '"></td>';
										echo '<td> <input disabled type="text" size="15" name="telefono" id="ptelefono' . $row['id_inscripto'] . '" value="'       . $row['telefono']       . '"></td>';
										echo '<td> <input disabled type="text" size="5"  name="disponibilidad" id="pdisponibilidad' . $row['id_inscripto'] . '" value="' . $row['disponibilidad'] . '"></td>';
										echo '<td> <input disabled type="text" size="2"  name="id_equipo" id="pid_equipo' . $row['id_inscripto'] . '" value="'      . $row['id_equipo']      . '"></td>';
										echo '<td> <button type="button" name="peditar"  class="btn-editar" value="' . $row['id_inscripto'] . '" id="peditar' . $row['id_inscripto'] . '">';
										echo '<i class="fa fa-pencil" aria-hidden="true"></i>';
										echo "</button></td>";
										echo '<td> <button name="penviar" type="submit" class="btn-enviar" id="penviar' . $row['id_inscripto'] . '" hidden>';
										echo '<i class="fa fa-check" aria-hidden="true"></i>';
										echo "</button></td>";
										echo '<td> <button name="pcancelar" type="button" class="btn-cancelar" id="pcancelar' . $row['id_inscripto'] . '" hidden>';
										echo '<i class="fa fa-times" aria-hidden="true"></i>';
										echo "</button></td>";
										echo "</tr>";
										echo "</form>";
									}
									mysqli_close($con);
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label class="label_cantidad_inscriptos">Participantes Inscriptos: </label>
					<?php
						$con = mysqli_connect('universys.site', 'apholos_dba', 'dbainub', 'apholos_ligaub');
						// Check connection
						$con->set_charset("utf8");
						if (mysqli_connect_errno())
						{
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}

						$result = mysqli_query($con,"SELECT * FROM Participantes where fecha_hasta is null");
						$rows=mysqli_affected_rows($con);
						echo '<label class="cantidad_inscriptos">'. $rows .'<label>';

						mysqli_close($con);
					?>
				</div>
				<div class="col-md-6">
					<form name="bajaParticipante" class="bajaParticipante" action="./php/bajaParticipante.php" runat="server" method="POST">
						<div class="form-group row">
							<label for="baja" class="col-md-3 col-form-label">Ingrese el ID del Participante</label>
							<div class="col-md-3">	
								<input class="form-control" type="text" name="baja_part" id="baja_part">
							</div>
							<div class="col-md-3">	
								<button type="submit" class="btn btn-primary btn-baja">Dar de Baja</button>
							</div>
						</div>
					</form>
				</div>
			</div>
	      	<div class="row">
	        	<div class="col-md-12 padding-top border-top">
		        	<h1>Ayudantes</h1>
		        	<div class="table-responsive">
						<table class="table table-condensed table-hover table-striped" width="60%" cellspacing="0">
							<thead>
								<tr>
									<th>Id</th>
									<th>Documento</th>
									<th>Nombre</th>
									<th>Apellido</th>
									<th>Email</th>
									<th>Telefono</th>
									<th>Disp.</th>
									<th colspan="3"></th>
								</tr>
							</thead>
							<tbody id="tabla_ayudantes">
								<?php
									$con = mysqli_connect('universys.site', 'apholos_dba', 'dbainub', 'apholos_ligaub');
									if (mysqli_connect_errno())
									{
									echo "Failed to connect to MySQL: " . mysqli_connect_error();
									}

									$result = mysqli_query($con,"SELECT * FROM Ayudantes where fecha_hasta is null");

									while($row = mysqli_fetch_array($result))
									{	
										echo '<form name="participante" class="" action="php/updateAyudante.php" runat="server" method="POST">';
										echo "<tr>";
										echo '<td> <input disabled type="text" size="3"  name="idAyudante" id="aid' . $row['id_inscripto'] . '" value="'   . $row['id_inscripto']   . '"></td>';
										echo '<td> <input disabled type="text" size="12" name="documento" id="adocumento' . $row['id_inscripto'] . '" value="'      . $row['documento']      . '"></td>';
										echo '<td> <input disabled type="text" size="12" name="nombre" id="anombre' . $row['id_inscripto'] . '" value="'         . $row['nombre']         . '"></td>';
										echo '<td> <input disabled type="text" size="12" name="apellido" id="aapellido' . $row['id_inscripto'] . '" value="'       . $row['apellido']       . '"></td>';
										echo '<td> <input disabled type="text" size="30" name="email" id="aemail' . $row['id_inscripto'] . '" value="'          . $row['email']          . '"></td>';
										echo '<td> <input disabled type="text" size="15" name="telefono" id="atelefono' . $row['id_inscripto'] . '" value="'       . $row['telefono']       . '"></td>';
										echo '<td> <input disabled type="text" size="5"  name="disponibilidad" id="adisponibilidad' . $row['id_inscripto'] . '" value="' . $row['disponibilidad'] . '"></td>';
										echo '<td> <button type="button" name="aeditar" class="btn-editar" value="' . $row['id_inscripto'] . '" id="aeditar' . $row['id_inscripto'] . '">';
										echo '<i class="fa fa-pencil" aria-hidden="true"></i>';
										echo "</button></td>";
										echo '<td> <button name="aenviar" type="submit" class="btn-enviar" id="aenviar' . $row['id_inscripto'] . '" hidden>';
										echo '<i class="fa fa-check" aria-hidden="true"></i>';
										echo "</button></td>";
										echo '<td> <button name="acancelar" type="button" class="btn-cancelar" id="acancelar' . $row['id_inscripto'] . '" hidden>';
										echo '<i class="fa fa-times" aria-hidden="true"></i>';
										echo "</button></td>";
										echo "</tr>";
										echo "</form>";
									}
									mysqli_close($con);
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label class="label_cantidad_inscriptos">Ayudantes Inscriptos: </label>
					<?php
						$con = mysqli_connect('universys.site', 'apholos_dba', 'dbainub', 'apholos_ligaub');
						// Check connection
						$con->set_charset("utf8");
						if (mysqli_connect_errno())
						{
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}

						$result = mysqli_query($con,"SELECT * FROM Ayudantes where fecha_hasta is null");
						$rows=mysqli_affected_rows($con);
						echo '<label class="cantidad_inscriptos">'. $rows .'<label>';

						mysqli_close($con);
					?>
				</div>
				<div class="col-md-6">
					<form name="bajaAyudante" class="bajaAyudante" action="./php/bajaAyudante.php" runat="server" method="POST">
						<div class="form-group row">
							<label for="baja" class="col-md-3 col-form-label">Ingrese el ID del Ayudante</label>
							<div class="col-md-3">	
								<input class="form-control" type="text" name="baja_part" id="baja_part">
							</div>
							<div class="col-md-3">	
								<button type="submit" class="btn btn-primary btn-baja">Dar de Baja</button>
							</div>
						</div>
					</form>
				</div>
			</div>
	    	<div class="row padding-top border-top">
	    		<div class="col-md-6">
			    	<h3>Equipos disponibles</h3>
			    	<div class="table-responsive">
				    	<table class="table table-condensed table-hover table-striped" width="60%" cellspacing="0">
							<thead>
								<tr>
									<th>Id</th>
									<th>Nombre</th>
								</tr>
							</thead>
							<tbody id="tabla_participantes">
								<?php
									$con = mysqli_connect('universys.site', 'apholos_dba', 'dbainub', 'apholos_ligaub');
									// Check connection
									$con->set_charset("utf8");
									if (mysqli_connect_errno())
									{
									echo "Failed to connect to MySQL: " . mysqli_connect_error();
									}

									$result = mysqli_query($con,"SELECT * FROM Equipos ORDER BY 2");

									while($row = mysqli_fetch_array($result))
									{
										echo "<tr><td>" . $row['id_equipo'] . "</td><td>" . $row['equipo_desc'] . "</td></tr>";
									}
									mysqli_close($con);
								?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-6">
			    	<h3>Horarios disponibles</h3>
			    	<div class="table-responsive">
				    	<table class="table table-condensed table-hover table-striped" width="60%" cellspacing="0">
							<thead>
								<tr>
									<th>Valores</th><th>1</th><th>1</th><th>1</th><th>1</th><th>1</th>
								</tr>
							</thead>
							<tbody id="tabla_participantes">
								<tr>
									<td>------</td><td>16:00 a 16:30hs</td><td>16:30 a 17:00hs</td><td>17:00 a 17:30hs</td><td>17:30 a 18:00hs</td><td>18:00 a 18:30hs</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
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
	
	function listener_edits() {
		var botonesEditarp=document.getElementsByName("peditar");
		for (var a=0; a<botonesEditarp.length; a++){
			botonesEditarp[a].onclick = function(){
				deshabilitar_campos_todos_p();
				deshabilitar_campos_todos_a();
				habilitar_campos_p(this.value);
			}
		}
		var botonesEditara=document.getElementsByName("aeditar");
		for (var a=0; a<botonesEditara.length; a++){
			botonesEditara[a].onclick = function(){
				deshabilitar_campos_todos_p();
				deshabilitar_campos_todos_a();
				habilitar_campos_a(this.value);
			}
		}
	}

	function listener_cancelar() {
		var botonesCancelarp=document.getElementsByName("pcancelar");
		for (var a=0; a<botonesCancelarp.length; a++){
			botonesCancelarp[a].onclick = function(){
				deshabilitar_campos_todos_p();
			}
		}
		var botonesCancelara=document.getElementsByName("acancelar");
		for (var a=0; a<botonesCancelara.length; a++){
			botonesCancelara[a].onclick = function(){
				deshabilitar_campos_todos_a();
			}
		}
	}

	function habilitar_campos_p(id){
		document.getElementById("peditar"+id).hidden=true;
		document.getElementById("penviar"+id).hidden=false;
		document.getElementById("pcancelar"+id).hidden=false;
		document.getElementById("pid"+id).disabled=false;
		document.getElementById("pid"+id).readonly="readonly";
		document.getElementById("pdocumento"+id).disabled=false;
		document.getElementById("pnombre"+id).disabled=false;
		document.getElementById("papellido"+id).disabled=false;
		document.getElementById("pemail"+id).disabled=false;
		document.getElementById("ptelefono"+id).disabled=false;
		document.getElementById("pdisponibilidad"+id).disabled=false;
		document.getElementById("pid_equipo"+id).disabled=false;
	}

	function habilitar_campos_a(id){
		document.getElementById("aeditar"+id).hidden=true;
		document.getElementById("aenviar"+id).hidden=false;
		document.getElementById("acancelar"+id).hidden=false;
		document.getElementById("aid"+id).disabled=false;
		document.getElementById("adocumento"+id).disabled=false;
		document.getElementById("anombre"+id).disabled=false;
		document.getElementById("aapellido"+id).disabled=false;
		document.getElementById("aemail"+id).disabled=false;
		document.getElementById("atelefono"+id).disabled=false;
		document.getElementById("adisponibilidad"+id).disabled=false;
	}

	function deshabilitar_campos_todos_p(){
		var botonesEditar=document.getElementsByName("peditar");
		for (var a=0; a<botonesEditar.length; a++){
			deshabilitar_campos_p(botonesEditar[a].value);
		}
	}

	function deshabilitar_campos_todos_a(){
		var botonesEditar=document.getElementsByName("aeditar");
		for (var a=0; a<botonesEditar.length; a++){
			deshabilitar_campos_a(botonesEditar[a].value);
		}
	}

	function deshabilitar_campos_p(id){
		document.getElementById("peditar"+id).hidden=false;
		document.getElementById("penviar"+id).hidden=true;
		document.getElementById("pcancelar"+id).hidden=true;
		document.getElementById("pid"+id).disabled=true;
		document.getElementById("pdocumento"+id).disabled=true;
		document.getElementById("pnombre"+id).disabled=true;
		document.getElementById("papellido"+id).disabled=true;
		document.getElementById("pemail"+id).disabled=true;
		document.getElementById("ptelefono"+id).disabled=true;
		document.getElementById("pdisponibilidad"+id).disabled=true;
		document.getElementById("pid_equipo"+id).disabled=true;
	}

	function deshabilitar_campos_a(id){
		document.getElementById("aeditar"+id).hidden=false;
		document.getElementById("aenviar"+id).hidden=true;
		document.getElementById("acancelar"+id).hidden=true;
		document.getElementById("aid"+id).disabled=true;
		document.getElementById("adocumento"+id).disabled=true;
		document.getElementById("anombre"+id).disabled=true;
		document.getElementById("aapellido"+id).disabled=true;
		document.getElementById("aemail"+id).disabled=true;
		document.getElementById("atelefono"+id).disabled=true;
		document.getElementById("adisponibilidad"+id).disabled=true;
	}


	window.onload= function(){
		listener_edits();
		listener_cancelar();
	}

</script>
</html>



































