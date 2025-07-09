<?php
// Solo procesa si se envió por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se aceptaron los términos
    if (!isset($_POST["terminos"])) {
        // Muestra mensaje de error si no se aceptaron los términos
        echo "<p style='color:red;'>Debes aceptar los términos y condiciones.</p>";
        exit;
    }

    // Captura y sanitiza los datos del formulario
    $nombre = htmlspecialchars($_POST["nombre"]);
    $edad = htmlspecialchars($_POST["edad"]);
    $correo = htmlspecialchars($_POST["correo"]);
    $genero = htmlspecialchars($_POST["genero"]);

    // Procesa el archivo subido
    $archivo = $_FILES["archivo"]["name"];
    $archivo_tmp = $_FILES["archivo"]["tmp_name"];

    // Crea la carpeta "uploads" si no existe
    if (!file_exists("uploads")) {
        mkdir("uploads", 0777, true);
    }

    // Define la ruta de destino para el archivo subido
    $ruta_destino = "uploads/" . basename($archivo);

    // Mueve el archivo subido a la carpeta de destino
    if (move_uploaded_file($archivo_tmp, $ruta_destino)) {
        $mensaje = "Archivo subido correctamente.";
    } else {
        // Si falla la subida, usa una imagen por defecto
        $mensaje = "Error al subir el archivo.";
        $ruta_destino = "https://via.placeholder.com/150";
    }

    // Muestra la tarjeta con los datos del usuario y la imagen
    echo "
    <!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Tarjeta de Usuario</title>
        <style>
            .tarjeta {
                border: 2px solid #333;
                border-radius: 10px;
                width: 300px;
                padding: 20px;
                margin: auto;
                font-family: sans-serif;
                text-align: center;
            }
            img {
                border-radius: 50%;
                width: 150px;
                height: 150px;
                object-fit: cover;
            }
        </style>
    </head>
    <body>
        <div class='tarjeta'>
            <h2>Tarjeta de Usuario</h2>
            <img src='$ruta_destino' alt='Foto del Usuario'>
            <p><strong>Nombre:</strong> $nombre</p>
            <p><strong>Edad:</strong> $edad</p>
            <p><strong>Correo:</strong> $correo</p>
            <p><strong>Género:</strong> $genero</p>
            <p><em>$mensaje</em></p>
        </div>
    </body>
    </html>
    ";
} else {
    // Si alguien entra directamente, redirige al formulario
    header("Location: index.html");
    exit;
}
