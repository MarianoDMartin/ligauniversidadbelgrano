<!DOCTYPE html>
<html>
<head>
	<title>Administración - Liga Universidad de Belgrano</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.js"></script>
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
						<li><a href="./index1.html">Inicio</a></li>
						<li><a href="./inscripcion.html">Inscripción</a></li>
						<li><a href="./soporte.html">Soporte</a></li>
						<li><a href="./academica.html">Información Académica</a></li>
					</ul>
				</nav>
			</div>
		</header>
		<div class="texto-encabezado text-center">
			<div class="container">
				<h1 class="display-4">Administración</h1>
				<p>Sección para administración del torneo</p>
			</div>
		</div>
	</section>
	<section class="ruta py-3"">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-sm-right">
                    <a href="index.html">Inicio</a> » Administración
                </div>
            </div>
        </div>
    </section>
	<main class="py-3 informacion-academica">
		<div class="container">
			


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
				<tbody id="employee_grid">
				</tbody>
			</table>




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
<script type="text/javascript">
$( document ).ready(function() {
	function getEmployee() {
		$.ajax({
		  type: "GET",  
		  url: "tab_response.php",
		  dataType: "json",       
		  success: function(response)  
		  {
			for (var i = 0; i < response.length; i++) {
				 $('#employee_grid').append(
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
	
	getEmployee();
	
	make_editable_col('#employee_grid','td.documento','tab_response.php?action=edit','documento');
	make_editable_col('#employee_grid','td.nombre','tab_response.php?action=edit','nombre');
	make_editable_col('#employee_grid','td.apellido','tab_response.php?action=edit','apellido');
	make_editable_col('#employee_grid','td.email','tab_response.php?action=edit','email');
	make_editable_col('#employee_grid','td.telefono','tab_response.php?action=edit','telefono');
	make_editable_col('#employee_grid','td.disponibilidad','tab_response.php?action=edit','disponibilidad');
	make_editable_col('#employee_grid','td.id_equipo','tab_response.php?action=edit','id_equipo');
	
	function ajaxAction(action) {
		data = $("#frm_"+action).serializeArray();
		$.ajax({
		  type: "POST",  
		  url: "tab_response.php",  
		  data: data,
		  dataType: "json",       
		  success: function(response)  
		  {
			$('#'+action+'_model').modal('hide');
			$("#employee_grid").bootgrid('reload');
		  }   
		});
	}
});
</script>
