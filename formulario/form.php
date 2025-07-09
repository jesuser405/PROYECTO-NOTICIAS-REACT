<?php

$nombre = $_POST['name'];
$correo = $_POST['email'];
$mensaje = $_POST['message'];

// como me va a llegar el mensaje

$mensaje = "Este mensaje fue enviado por" . $nombre . "\r\n";
$mensaje .= "Su correo es" . $correo . "\r\n";
$mensaje .= "Mensaje: " . $mensaje . "\r\n";
$mensaje .= "Enviado el" . date('d/m/Y', time());

$para = "jesuser405@hotmail.com";
$asunto = "Mensaje de mi pagina web";

// funcion mail 
// A quien le envio el mail
mail($para, $asunto, utf8_decode($mensaje),$header);

// header
header("Location:gracias.html");

