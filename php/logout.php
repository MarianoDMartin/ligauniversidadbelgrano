<?php
session_start();
session_destroy();
echo "<script language='javascript'>
		alert('Gracias por usar el sistema!!! Hasta Pronto!!!');
		window.location.href = '../index.html';
		</script>";
?>