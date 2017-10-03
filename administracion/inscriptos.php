<?php
session_start();
if ($_SESSION['usuario']=="")
    header("Location: ../index.html");
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Administracion</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top navAdministracion">
	  <div class="container">
	  	<div class="row">
	    	<div class="col-md-10 tituloAdministracion">
	    		Administración del Sistema - Uiversys - LigaUB
	    	</div>
	    	<div class="col-md-2">
	    		<a href='php/logout.php'>Cerrar Sesión</a>
	    	</div>
	    </div>
	  </div>
	</nav>
	<main class="py-3">
		<div class="container">
	      <div class="">
	        <h1 class="separarNav">Participantes</h1>
	        <div>
				<table class="table table-condensed table-hover table-striped" width="60%" cellspacing="0">
					<thead>
						<tr>
							<th>Id</th>
							<th>Documento</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Email</th>
							<th>Telefono</th>
							<th>Disponibilidad</th>
							<th>Equipo</th>
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
								echo '<form name="participante" class="" action="." runat="server" method="POST">';
								echo "<tr>";
								echo '<td> <input disabled type="text" size="3"  name="id_inscripto" id="id_inscripto' . $row['id_inscripto'] . '" value="'   . $row['id_inscripto']   . '"</td>';
								echo '<td> <input disabled type="text" size="12" name="documento" id="documento' . $row['id_inscripto'] . '" value="'      . $row['documento']      . '"</td>';
								echo '<td> <input disabled type="text" size="15" name="nombre" id="nombre' . $row['id_inscripto'] . '" value="'         . $row['nombre']         . '"</td>';
								echo '<td> <input disabled type="text" size="15" name="apellido" id="apellido' . $row['id_inscripto'] . '" value="'       . $row['apellido']       . '"</td>';
								echo '<td> <input disabled type="text" size="35" name="email" id="email' . $row['id_inscripto'] . '" value="'          . $row['email']          . '"</td>';
								echo '<td> <input disabled type="text" size="15" name="telefono" id="telefono' . $row['id_inscripto'] . '" value="'       . $row['telefono']       . '"</td>';
								echo '<td> <input disabled type="text" size="5"  name="disponibilidad" id="disponibilidad' . $row['id_inscripto'] . '" value="' . $row['disponibilidad'] . '"</td>';
								echo '<td> <input disabled type="text" size="2"  name="id_equipo" id="id_equipo' . $row['id_inscripto'] . '" value="'      . $row['id_equipo']      . '"</td>';
								echo '<td> <button name="editar" value="' . $row['id_inscripto'] . '">';
								echo '<i class="fa fa-pencil" aria-hidden="true"></i>';
								echo "</button></td>";
								echo '<td> <button name="update" type="send">Enviar</button></td>';
								echo "</tr>";
								echo "</form>";
							}
							mysqli_close($con);
						?>
						
					</tbody>
				</table>
			</div>
			<div class="container">
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
			</div>
	      </div>
	    </div>
	    <div class="container">
	      <div class="">
	        <h1>Ayudantes</h1>
	        <div>
				<table class="table table-condensed table-hover table-striped" width="60%" cellspacing="0">
					<thead>
						<tr>
							<th>Id</th>
							<th>Documento</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Email</th>
							<th>Telefono</th>
							<th>Disponibilidad</th>
						</tr>
					</thead>
					<tbody id="tabla_ayudantes">
					</tbody>
				</table>
			</div>
			<div class="container">
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
			</div>
	      </div>
	    </div>
	    <div class="container">
	    	<div class="row">
	    		<div class="col-md-6">
			    	<h3>Equipos disponibles</h3>
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
				<div class="col-md-6">
			    	<h3>Horarios disponibles</h3>
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
	</main>
	<footer class="pieAdministracion"" role="contentinfo">
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
		var botonesEditar=document.getElementsByName("editar");
		for (var a=0; a<botonesEditar.length; a++){
			botonesEditar[a].onclick = function(){
				debugger;
				alert(this.value);
				habilitar_campos(botonesEditar[a].value);
			}
		}
	}

	function habilitar_campos(id){
		alert(id);
	}

	window.onload= function(){ 
		listener_edits();
	}
</script>
</html>



































