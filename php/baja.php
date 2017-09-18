<?php  //Start the Session

session_start();
$connection = mysqli_connect('universys.site', 'apholos_dba', 'dbainub', 'apholos_ligaub');

if (mysqli_connect_errno()) {
	die("Database connection failed: " .
		mysqli_connect_error() .
		" (" . mysqli_connect_errno() . ")"
	);
}

if (isset($_POST['baja_part'])){

	$id_baja = $_POST['baja_part'];

	$query = "UPDATE Participantes set fecha_hasta = now() WHERE id_inscripto='".$id_baja."'";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

    if ($result) {
        echo "<script language='javascript'>
        alert('Se hizo la baja correctamente');
        </script>";
    } else {
        echo "<script language='javascript'>
        alert('Hubo un error, intente nuevamente por favor');
        </script>";
    }	
}
if (isset($_POST['baja_ayud'])){

	$id_baja = $_POST['baja_ayud'];

	$query = "UPDATE Ayudantes set fecha_hasta = now() WHERE id_inscripto='".$id_baja."'";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

    if ($result) {
        echo "<script language='javascript'>
        alert('Se hizo la baja correctamente');
        </script>";
    } else {
        echo "<script language='javascript'>
        alert('Hubo un error, intente nuevamente por favor');
        </script>";
    }	
}

//3.2 When the user visits the page first time, simple login form will be displayed.
	?>