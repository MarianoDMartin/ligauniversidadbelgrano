<?php
session_start();
if ($_SESSION['usuario']=="")
    header("Location: index.html");
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administracion</title>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/estilos.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.js"></script>
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
	        <div class="col-md-12">
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
					</tbody>
				</table>
			</div>
			<div>
				<form name="bajaParticipante" class="bajaParticipante" action="./php/bajaParticipante.php" runat="server" method="POST">
					<div class="form-group row">
						<label for="baja" class="col-md-3 col-form-label">Ingrese el ID del Participante</label>
						<div class="col-md-3">	
							<input class="form-control" type="text" name="baja_part" id="baja_part">
						</div>
						<div class="col-md-3">	
							<button type="submit" class="btn btn-primary">Dar de Baja</button>
						</div>
					</div>
				</form>
			</div>
	      </div>
	    </div>
	    <div class="container">
	      <div class="">
	        <h1>Ayudantes</h1>
	        <div class="col-md-12">
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
			<div>
				<form name="bajaAyudante" class="bajaAyudante" action="./php/bajaAyudante.php" runat="server" method="POST">
					<div class="form-group row">
						<label for="baja" class="col-md-3 col-form-label">Ingrese el ID del Ayudante</label>
						<div class="col-md-3">	
							<input class="form-control" type="text" name="baja_part" id="baja_part">
						</div>
						<div class="col-md-3">	
							<button type="submit" class="btn btn-primary">Dar de Baja</button>
						</div>
					</div>
				</form>
			</div>
	      </div>
	    </div>
	    <div class="container">
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
	</main>
	<footer class="pieAdministracion"" role="contentinfo">
        <div class="container">
            <p>2017 - Universys Facultad de Tecnología UB </br>Todos los derechos reservados</p>
        </div>
    </footer>
</body>
</html>
<script type="text/javascript">
$( document ).ready(function() {
	function get_participante() {
		$.ajax({
		  type: "GET",  
		  url: "/php/tab_response_participante.php",
		  dataType: "json",       
		  success: function(response)  
		  {
			for (var i = 0; i < response.length; i++) {
				 $('#tabla_participantes').append(
				 		"<tr><td>" + response[i].id_inscripto + 
				 		"</td><td data-name='documento' class='documento' data-type='text' data-pk='"+response[i].id_inscripto+"'>" + response[i].documento + 
				 		"</td><td data-name='nombre' class='nombre' data-type='text' data-pk='"+response[i].id_inscripto+"'>" + response[i].nombre + 
				 		"</td><td data-name='apellido' class='apellido' data-type='text' data-pk='"+response[i].id_inscripto+"'>" + response[i].apellido + 
				 		"</td><td data-name='email' class='email' data-type='text' data-pk='"+response[i].id_inscripto+"'>" + response[i].email + 
				 		"</td><td data-name='telefono' class='telefono' data-type='text' data-pk='"+response[i].id_inscripto+"'>" + response[i].telefono + 
				 		"</td><td data-name='disponibilidad' class='disponibilidad' data-type='text' data-pk='"+response[i].id_inscripto+"'>" + response[i].disponibilidad + 
				 		"</td><td data-name='id_equipo' class='id_equipo' data-type='text' data-pk='"+response[i].id_inscripto+"'>" + response[i].id_equipo + "</td></tr>");
			 }
		  },
		 error: function(jqXHR, textStatus, errorThrown) {
			 alert("loading error data " + errorThrown);
		 }
		});
	}

	
	function make_editable_col(table_selector,column_selector,ajax_url,title) {
		$(table_selector).editable({   
			selector: column_selector,
			url: ajax_url,
			title: title,
			type: "POST",
			dataType: 'json'
		  });
		  $.fn.editable.defaults.mode = 'inline';
		}
	
	get_participante();
	
	make_editable_col('#tabla_participantes','td.documento','/php/tab_response_participante.php?action=edit','documento');
	make_editable_col('#tabla_participantes','td.nombre','/php/tab_response_participante.php?action=edit','nombre');
	make_editable_col('#tabla_participantes','td.apellido','/php/tab_response_participante.php?action=edit','apellido');
	make_editable_col('#tabla_participantes','td.email','/php/tab_response_participante.php?action=edit','email');
	make_editable_col('#tabla_participantes','td.telefono','/php/tab_response_participante.php?action=edit','telefono');
	make_editable_col('#tabla_participantes','td.disponibilidad','/php/tab_response_participante.php?action=edit','disponibilidad');
	make_editable_col('#tabla_participantes','td.id_equipo','/php/tab_response_participante.php?action=edit','id_equipo');
	
	function ajaxAction_part(action) {
		data = $("#frm_"+action).serializeArray();
		$.ajax({
		  type: "POST",  
		  url: "/php/tab_response_participante.php",  
		  data: data,
		  dataType: "json",       
		  success: function(response)  
		  {
			$('#'+action+'_model').modal('hide');
			$("#tabla_participantes").bootgrid('reload');
		  }   
		});
	}

	function get_ayudante() {
		$.ajax({
		  type: "GET",  
		  url: "/php/tab_response_ayudante.php",
		  dataType: "json",       
		  success: function(response)  
		  {
			for (var i = 0; i < response.length; i++) {
				 $('#tabla_ayudantes').append(
				 		"<tr><td>" + response[i].id_inscripto + 
				 		"</td><td data-name='documento' class='documento' data-type='text' data-pk='"+response[i].id_inscripto+"'>" + response[i].documento + 
				 		"</td><td data-name='nombre' class='nombre' data-type='text' data-pk='"+response[i].id_inscripto+"'>" + response[i].nombre + 
				 		"</td><td data-name='apellido' class='apellido' data-type='text' data-pk='"+response[i].id_inscripto+"'>" + response[i].apellido + 
				 		"</td><td data-name='email' class='email' data-type='text' data-pk='"+response[i].id_inscripto+"'>" + response[i].email + 
				 		"</td><td data-name='telefono' class='telefono' data-type='text' data-pk='"+response[i].id_inscripto+"'>" + response[i].telefono + 
				 		"</td><td data-name='disponibilidad' class='disponibilidad' data-type='text' data-pk='"+response[i].id_inscripto+"'>" + response[i].disponibilidad + "</td></tr>");
			 }
		  },
		 error: function(jqXHR, textStatus, errorThrown) {
			 alert("loading error data " + errorThrown);
		 }
		});
	}

	get_ayudante();
	
	make_editable_col('#tabla_ayudantes','td.documento','/php/tab_response_ayudante.php?action=edit','documento');
	make_editable_col('#tabla_ayudantes','td.nombre','/php/tab_response_ayudante.php?action=edit','nombre');
	make_editable_col('#tabla_ayudantes','td.apellido','/php/tab_response_ayudante.php?action=edit','apellido');
	make_editable_col('#tabla_ayudantes','td.email','/php/tab_response_ayudante.php?action=edit','email');
	make_editable_col('#tabla_ayudantes','td.telefono','/php/tab_response_ayudante.php?action=edit','telefono');
	make_editable_col('#tabla_ayudantes','td.disponibilidad','/php/tab_response_ayudante.php?action=edit','disponibilidad');
	
	function ajaxAction_ayud(action) {
		data = $("#frm_"+action).serializeArray();
		$.ajax({
		  type: "POST",  
		  url: "/php/tab_response_ayudante.php",  
		  data: data,
		  dataType: "json",       
		  success: function(response)  
		  {
			$('#'+action+'_model').modal('hide');
			$("#tabla_ayudantes").bootgrid('reload');
		  }   
		});
	}
});
</script>
