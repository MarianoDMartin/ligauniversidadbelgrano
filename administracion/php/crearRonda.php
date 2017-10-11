<?php  //Start the Session

$connection = mysqli_connect('universys.site', 'apholos_dba', 'dbainub', 'apholos_ligaub');

if (mysqli_connect_errno()) {
	die("Database connection failed: " .
		mysqli_connect_error() .
		" (" . mysqli_connect_errno() . ")"
	);
}
$ronda = $_POST['ronda'];
$consolas = $_POST['consolas'];
$fechas=$_POST['fechas'];
$query="TRUNCATE TABLE consolas";
$result=mysqli_query($connection, $query) or die(mysqli_error($connection));
$query="INSERT INTO consolas (cantidad) VALUE ('" . $consolas . "')";
$result=mysqli_query($connection, $query) or die(mysqli_error($connection));

if ($result){
    foreach ($fechas as $fecha) {
        $query = "INSERT INTO fechas_disponibles(fecha,ronda) VALUE ('" . $fecha . "','" . $ronda . "');";
        $result=mysqli_query($connection, $query) or die(mysqli_error($connection));
    }
    mysqli_close($connection);
    echo "<script language='javascript'>
    window.location.href = 'generarPartidos.php';
    </script>";
}else{
    mysqli_close($connection);
    echo "<script language='javascript'>
    alert('Hubo un error, verifique los datos ingresados e intente nuevamente');
    window.location.href = '../torneo.php';
    </script>";
}
?>