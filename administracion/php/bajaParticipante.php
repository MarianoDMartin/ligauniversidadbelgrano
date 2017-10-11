<?php  //Start the Session

$connection = mysqli_connect('universys.site', 'apholos_dba', 'dbainub', 'apholos_ligaub');

if (mysqli_connect_errno()) {
	die("Database connection failed: " .
		mysqli_connect_error() .
		" (" . mysqli_connect_errno() . ")"
	);
}
$id_baja = $_POST['baja_part'];

$query = "UPDATE Participantes set fecha_hasta = now() WHERE id_inscripto='".$id_baja."'";
$result=mysqli_query($connection, $query) or die(mysqli_error($connection));
$rows=mysqli_affected_rows($connection);
if ($rows>0) {
    echo "<script language='javascript'>
    alert('Se hizo la baja correctamente');
    window.location.href = '../inscriptos.php';
    </script>";
} else {
    echo "<script language='javascript'>
    alert('Hubo un error, verifique el id ingresado e intente nuevamente por favor');
    window.location.href = '../inscriptos.php';
    </script>";
}	

//3.2 When the user visits the page first time, simple login form will be displayed.
	?>