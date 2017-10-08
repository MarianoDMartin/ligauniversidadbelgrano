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
$goles1 = $_POST['goles1'];
$goles2 = $_POST['goles2'];
$id_participante1 = $_POST['id_participante1'];
$id_participante2 = $_POST['id_participante2'];

$query = "UPDATE Partidos set goles1='$goles1' , goles2='$goles2' WHERE id_partido='".$id."'";
$result=mysqli_query($connection, $query) or die(mysqli_error($connection));
$rows=mysqli_affected_rows($connection);
if($rows>0){
    if($goles1>$goles2){
        $query = "UPDATE participantes_desarrollo set fecha_hasta = now() WHERE id_inscripto='".$id_participante2."'";
    }else{
        $query = "UPDATE participantes_desarrollo set fecha_hasta = now() WHERE id_inscripto='".$id_participante1."'";
    }
    $result=mysqli_query($connection, $query) or die(mysqli_error($connection));
}
if ($rows>0) {
    echo "<script language='javascript'>
    alert('Carga realizada correctamente');
    window.location.href = '../resultados.php';
    </script>";
} else {
    echo "<script language='javascript'>
    alert('Hubo un error, verifique los datos cargados e intente nuevamente');
    window.location.href = '../resultados.php';
    </script>";
}
?>	