<?php  //Start the Session

$connection = mysqli_connect('universys.site', 'apholos_dba', 'dbainub', 'apholos_ligaub');

if (mysqli_connect_errno()) {
	die("Database connection failed: " .
		mysqli_connect_error() .
		" (" . mysqli_connect_errno() . ")"
	);
}
$id = $_POST['idParticipante'];
$documento = $_POST['documento'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$disponibilidad = $_POST['disponibilidad'];
$equipo = $_POST['id_equipo'];

$query = "UPDATE Participantes set documento='$documento' , nombre='$nombre' , apellido='$apellido' , email='$email', telefono='$telefono' , disponibilidad='$disponibilidad' , id_equipo='$equipo' WHERE id_inscripto='".$id."'";


$result=mysqli_query($connection, $query) or die(mysqli_error($connection));
mysqli_close($connection);
if ($result>0) {
    echo "<script language='javascript'>
    alert('Modificacion realizada corrextamente');
    window.location.href = '../inscriptos.php';
    </script>";
} else {

    echo "<script language='javascript'>
    alert('Hubo un error, verifique la modificacion que quiere realizar e intente nuevamente');
    window.location.href = '../inscriptos.php';
    </script>";
}	
