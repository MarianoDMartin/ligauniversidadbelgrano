<?php
	$id = $_POST['idParticipante'];
	$nombre = $_POST['nombre'];
	echo "<script language='javascript'>
        alert('$id $nombre');
        window.location.href = '../inscriptos.php';
        </script>";
?>