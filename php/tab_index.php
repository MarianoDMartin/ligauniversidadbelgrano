<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bhamo la tabla guacho</title>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.js"></script>
</head>
<body>
	<div class="container">
      <div class="">
        <h1>Simple X-Editable inline editing using PHP,MySQL and AJAX</h1>
        <div class="col-sm-8">
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
      </div>
    </div>
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
