<?php  //Start the Session

session_start();
$connection = mysqli_connect('universys.site', 'apholos_dba', 'dbainub', 'apholos_ligaub');

if (mysqli_connect_errno()) {
	die("Database connection failed: " .
		mysqli_connect_error() .
		" (" . mysqli_connect_errno() . ")"
	);
}
$id = $_POST['id_partido'];
$fecha = $_POST['fechas'];
$horario = $_POST['horarios'];

$query = "UPDATE Partidos set fecha='$fecha' , hora='$horario' WHERE id_partido='".$id."'";
$result=mysqli_query($connection, $query) or die(mysqli_error($connection));

if ($result) {
    echo "<script language='javascript'>
    alert('Modificacion realizada corrextamente');
    window.location.href = '../torneo.php';
    </script>";
} else {
    echo "<script language='javascript'>
    alert('Hubo un error, verifique la modificacion que quiere realizar e intente nuevamente');
    window.location.href = '../torneo.php';
    </script>";
}
?>	