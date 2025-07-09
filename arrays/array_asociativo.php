<?php
 
$agenda = array(
    array(
        "id" => 1,
        "nombre" => "Sophia",
        "telefono" => 20535964,
        "correo" => "sophia@prueba.com"
    ),
    array(
        "id" => 2,
        "nombre" => "Marcela",
        "telefono" => 2976372,
        "correo" => "marcela@prueba.com"
    ),
    array(
        "id" => 3,
        "nombre" => "Carlos",
        "telefono" => 2160541,
        "correo" => "carlos@prueba.com"
    ),
    array(
        "id" => 4,
        "nombre" => "Daniela",
        "telefono" => 2457853,
        "correo" => "daniela@prueba.com"
    )
);
echo "Los nombres de todos los contactos son : ";
 
foreach ($agenda as $contacto) {
    $todoscontactos = $contacto['nombre'];
    echo "<hr>";
    echo "<br> Nombre: " . $contacto['nombre'];
    echo "<br> Telefono: " . $contacto['telefono'];
    echo "<br> Correo: " . $contacto['correo'];
}
 
$nuevo_contacto= array(
   
        "nombre" => "Alicia",
        "telefono" => 24587553,
        "correo" => "alicia@prueba.com");
 
        echo "<h1>Lista modificada: </h1><hr>";
        foreach ($agenda as $contacto) {
            $todoscontactos = $contacto['nombre'];
            echo "<br> Nombre: " . $contacto['nombre'];
            echo "<br> Telefono: " . $contacto['telefono'];
            echo "<br> Correo: " . $contacto['correo'];
       
 
       
           
    }
