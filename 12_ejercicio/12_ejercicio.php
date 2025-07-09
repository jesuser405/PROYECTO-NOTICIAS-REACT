<?php   
// Verifica si el formulario fue enviado por método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene los valores enviados por el formulario
    $nombre = $_POST['nombre'];
    $contenido = $_POST['contenido'];

    // Si no existe el directorio 'archivos', lo crea
    if (!is_dir('archivos')) mkdir('archivos');

    // Abre (o crea) el archivo con el nombre proporcionado, en modo escritura
    $archivo = fopen("archivos/".$nombre.".txt", "w");

    // Escribe el contenido en el archivo
    fwrite($archivo, "Nombre: $nombre\nContenido: $contenido");

    // Cierra el archivo
    fclose($archivo);

    // Muestra mensaje de éxito
    echo "Archivo creado con éxito.";
    // fwrite($archivo,$_POST['textarea']); // Línea comentada, no se utiliza
}