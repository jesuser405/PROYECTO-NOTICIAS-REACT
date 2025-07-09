<?php

function validaror($data){
     
    $data = trim($data); // Elimina espacios en blanco al inicio y al final
    $data = stripslashes($data); // Elimina las barras invertidas
    $data = htmlspecialchars($data); // Convierte caracteres especiales a entidades HTML
    return $data; // Devuelve el dato validado
}

$nombre = validaror($_POST['nombre']); // Valida el nombre
$contenido = validaror($_POST['contenido']); // Valida el contenido
// Verifica si el formulario fue enviado por método POST

echo "Nombre: $nombre\nContenido: $contenido"; // Muestra el nombre y contenido validados