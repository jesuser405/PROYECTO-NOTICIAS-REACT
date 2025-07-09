<?php
session_start();

$error = "";

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $respuesta = isset($_POST['respuesta']) ? intval($_POST['respuesta']) : null;

    if ($respuesta === 14) {
        $_SESSION['acceso'] = true;
        header("Location: /MODULO%202/UF-1%202/contenido.php");
        exit();
    } else {
        $error = "❌ Respuesta incorrecta. Intenta de nuevo.";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso</title>
    <link href="/MODULO%202/UF-1%202/style.css" rel="stylesheet">

</head>
<body>
    <div>
        <button id="bienvenido">Bienvenido a la prueba de acceso</button>
    </div>

    <script>
        document.getElementById('bienvenido').addEventListener('click', function() {
            window.location.href = '/MODULO%202/UF-1%202/index12.php';
        });
    </script>
</body>
</html>
