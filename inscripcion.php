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
	<script>

		function habilitar(value){
			if(value=="1" || value==true){
				// habilitamos
				document.getElementById("equipos").disabled=false;
			}else if(value=="2" || value==false){
				// deshabilitamos
				document.getElementById("equipos").disabled=true;
			}
		}

		function validarMotivo(form){
			if (form.motivo.value!="1" && form.motivo.value!="2"){
				alert('Debes seleccionar un motivo');
				return false;
			}else{
				return true;
			}
		}
		function validarDisponibilidad(form){
			cantidad=0;
			if (form.disponibilidad1.checked) cantidad=cantidad+1;
			if (form.disponibilidad2.checked) cantidad=cantidad+1;
			if (form.disponibilidad3.checked) cantidad=cantidad+1;
			if (form.disponibilidad4.checked) cantidad=cantidad+1;
			if (form.disponibilidad5.checked) cantidad=cantidad+1;
			if (cantidad<=1){
				alert('Debes seleccionar al menos dos disponibilidades'); 
				return false; 	
			}else{ 
			return true;
			} 
		}

		function validarEquipo(form){
			if(form.motivo.value=="2")return true;
			indice = form.equipos.selectedIndex;
			if( indice == null || indice == 0 ) {
				alert('Debes seleccionar un equipo');
  				return false;
			}else{
				return true;
			}
		}

		function validar(form){
			if(!validarMotivo(form)){
				return false;
			}else if(!validarDisponibilidad(form)){
				return false;
			}else if(!validarEquipo(form)){
				return false;
			}
			return true;
		}

	</script>
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
						<li class="active"><a href="./inscripcion.php">Inscripción</a></li>
						<li><a href="./soporte.html">Soporte</a></li>
						<li><a href="./academica.html">Información Académica</a></li>
					</ul>
				</nav>
			</div>
		</header>
		<div class="texto-encabezado text-center">
			<div class="container">
				<h1 class="display-4">Inscripcion</h1>
				<p>Llená el formulario para inscribirte al mejor torneo de FIFA</p>
			</div>
		</div>
	</section>
	<section class="ruta py-3"">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-sm-right">
                    <a href="index.html">Inicio</a> » Inscripción
                </div>
            </div>
        </div>
    </section>
	<main class="py-3">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="mb-4">Formulario de Inscripción</h2>
					<form name="inscripcion" class="formInscripcion" action="./php/inscribirBase.php" runat="server" onsubmit='return validar(this);' method="POST">
						<div class="form-group row">
							<label for="documento" class="col-md-4 col-form-label">Documento</label> 
							<div class="col-md-8">
								<input class="form-control" type="text" name="documento" id="documento" required pattern="[0-9]{1,12}" title="Debe ingresar solo valores numéricos de hasta 12 caracteres" required placeholder="documento sin puntos, solo numeros">
							</div>
						</div>
						<div class="form-group row">
							<label for="nombre" class="col-md-4 col-form-label" >Nombre</label> 
							<div class="col-md-8">	
								<input class="form-control" type="text" name="nombre" id="nombre" required placeholder="Juan">
							</div>
						</div>
						<div class="form-group row">
							<label for="apellido" class="col-md-4 col-form-label">Apellido</label> 
							<div class="col-md-8">
								<input class="form-control" type="text" name="apellido" id="apellido" required placeholder="Perez">
							</div>
						</div>
						<div class="form-group row">
							<label for="email" class="col-md-4 col-form-label" >Email</label> 
							<div class="col-md-8">
								<input class="form-control" type="email" name="email" id="email"  required placeholder="email@email.com">
							</div>
						</div>
						<div class="form-group row">
							<label for="telefono" class="col-md-4 col-form-label">Teléfono</label>
								<div class="col-md-8">	
									<input class="form-control" type="tel" name="telefono" id="telefono" placeholder="1165281232">
								</div>
						</div>
						<div class="form-group row">
							<label for="motivo" class="col-md-4 col-form-label">Motivo</label>
								<div class="col-md-8">
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
										if ($rows>=256){
											echo "<input type=\"radio\" name=\"motivo\" value=\"1\" onchange=\"habilitar(this.value);\" disabled> Participante <strong>Cupos LLenos</strong><br>";
										}
										else{
											echo "<input type=\"radio\" name=\"motivo\" value=\"1\" onchange=\"habilitar(this.value);\"> Participante<br>";
										}
				
										mysqli_close($con);
									?>
			  						<input type="radio" name="motivo" value="2" onchange="habilitar(this.value);"> Ayudante<br>
			  					</div>
						</div>
						<div class="form-group row">
							<label for="disponibilidad" class="col-md-4 col-form-label">Disponibilidad</label>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										16:00 a 16:30hs <input type='checkbox' name='disponibilidad1' value='1' />
									</div>
									<div class="col-md-2">
										16:30 a 17:00hs <input type='checkbox' name='disponibilidad2' value='1' />
									</div>
									<div class="col-md-2">
										17:00 a 17:30hs <input type='checkbox' name='disponibilidad3' value='1' />
									</div>
									<div class="col-md-2">
										17:30 a 18:00hs <input type='checkbox' name='disponibilidad4' value='1' />
									</div>
									<div class="col-md-2">
										18:00 a 18:30hs <input type='checkbox' name='disponibilidad5' value='1' />
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="equipos" class="col-md-4 col-form-label">Equipo</label>
							<div class="col-md-8">
								<select class="form-control" name="equipos" id="equipos" disabled>
									<option value="">Seleccione su Equipo</option>
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
											echo "<option value=\"" . $row['id_equipo'] . "\">" . $row['equipo_desc'] . "</option>";
										}
										mysqli_close($con);
									?>
								</select>
							</div>
						</div>
						<div class="form-group row">
                        	<div class="col-md-8 ml-md-4">
                                <button type="submit" class="btn btn-primary">Inscribirse</button>   
                            	<button type="reset" class="btn btn-secondary">Limpiar</button>
                        	</div>
                    	</div>
					</form>
				</div>
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