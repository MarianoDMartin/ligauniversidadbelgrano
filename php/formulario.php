<?php
//Importamos las variables del formulario de contacto
@$nombre = addslashes($_POST["nombre"]);
@$email = addslashes($_POST['email']);
@$motivo = addslashes($_POST['motivoMensaje']);
@$mensaje = addslashes($_POST['mensaje']);
 
//Preparamos el mensaje de contacto
$cabeceras = "From: $email\n" //La persona que envia el correo
 . "Reply-To: $email\n";
$asunto = "Mensaje desde tiempocreaciones.com.ar"; //asunto aparecera en la bandeja del servidor de correo
$email_to = "mariano.d.martin@gmail.com"; //cambiar por tu email
$contenido = "\n"
. "Nombre: $nombre\n"
. "Email: $email\n"
. "Motivo: $motivo\n"
. "Mensaje: $mensaje\n"
. "\n";
 
//Enviamos el mensaje y comprobamos el resultado
if (@mail($email_to, $asunto ,$contenido ,$cabeceras )) {
 
//Si el mensaje se envía muestra una confirmación
die("Gracias, su mensaje se envio correctamente.");
}else{
 
//Si el mensaje no se envía muestra el mensaje de error
die("Error: Su mensaje no se pudo enviar, intente más tarde");
}
?>