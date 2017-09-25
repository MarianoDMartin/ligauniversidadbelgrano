<?php

function get_with_default($arr, $key, $defval)
{
  return isset($arr[$key]) ? $arr[$key] : $defval;
}

 // Create a database connection.
$connection = mysqli_connect('universys.site', 'apholos_dba', 'dbainub', 'apholos_ligaub');

//Test if connection occurred.
if (mysqli_connect_errno()) {
    die("<script language='javascript'>
    alert('Hubo un error de conexion, intente nuevamente por favor');
    window.location.href = ../inscripcion.php';
    </script>");
}

//Perform database query
$documento = $_POST['documento'];
$nombre= $_POST['nombre'];
$apellido = $_POST['apellido'];
$email= $_POST['email'];
$telefono= $_POST['telefono'];
$motivo = $_POST['motivo'];
$disponibilidad = get_with_default($_POST,'disponibilidad1','0') . get_with_default($_POST,'disponibilidad2','0') . get_with_default($_POST,'disponibilidad3','0') . get_with_default($_POST,'disponibilidad4','0') . get_with_default($_POST,'disponibilidad5','0') ;
$equipos = $_POST['equipos'];

$documento = mysqli_real_escape_string($connection, $documento);
$nombre = mysqli_real_escape_string($connection, $nombre);
$apellido = mysqli_real_escape_string($connection, $apellido);
$email = mysqli_real_escape_string($connection, $email);
$telefono = mysqli_real_escape_string($connection, $telefono);
$motivo = mysqli_real_escape_string($connection, $motivo);
$disponibilidad = mysqli_real_escape_string($connection, $disponibilidad);
$equipos = intval(mysqli_real_escape_string($connection, $equipos));

//abro en dos los inserts
//participantes

if ($motivo == '1'){
    $documento = $_POST['documento'];
    $query = "SELECT * FROM Participantes WHERE documento='$documento'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);

    if ($count >= 1)
    {
        echo "<script language='javascript'>
        alert('ERROR: documento ya registrado');
        window.location.href = '../inscripcion.php';
        </script>";
    }

    $email = $_POST['email'];
    $query = "SELECT * FROM Participantes WHERE email='$email'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);

    if ($count >= 1)
    {
        echo "<script language='javascript'>
        alert('ERROR: EMAIL ya registrado');
        window.location.href = '../inscripcion.php';
        </script>";
    }


    $query  = "INSERT INTO Participantes ( documento, nombre, apellido, email, telefono, disponibilidad, id_equipo, fecha_desde) 
    VALUES ('".$documento."','".$nombre."','".$apellido."','".$email."','".$telefono."','".$disponibilidad."','".$equipos."',now())";

    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "<script language='javascript'>
        alert('Usted se ha inscripto correctamente como participante!');
        window.location.href = '../index.html';
        </script>";
    } else {
        echo "<script language='javascript'>
        alert('Hubo un error, intente nuevamente por favor');
        window.location.href = '../inscripcion.php';
        </script>";
    }

    mysqli_close($connection);
}

if ($motivo == '2'){
    $documento = $_POST['documento'];
    $query = "SELECT * FROM Ayudantes WHERE documento='$documento'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);

    if ($count >= 1)
    {
        echo "<script language='javascript'>
        alert('ERROR: documento ya registrado');
        window.location.href = '../inscripcion.php';
        </script>";
    }

    $email = $_POST['email'];
    $query = "SELECT * FROM Ayudantes WHERE email='$email'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);

    if ($count >= 1)
    {
        echo "<script language='javascript'>
        alert('ERROR: EMAIL ya registrado');
        window.location.href = '../inscripcion.php';
        </script>";
    }


    $query  = "INSERT INTO Ayudantes ( documento, nombre, apellido, email, telefono, disponibilidad, fecha_desde) 
    VALUES ('".$documento."','".$nombre."','".$apellido."','".$email."','".$telefono."','".$disponibilidad."',now())";

    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "<script language='javascript'>
        alert('Usted se ha inscripto correctamente como ayudante!');
        window.location.href = '../index.html';
        </script>";
    } else {
        echo "<script language='javascript'>
        alert('Hubo un error, intente nuevamente por favor');
        window.location.href = '../inscripcion.php';
        </script>";
    }

    mysqli_close($connection);
}
?>