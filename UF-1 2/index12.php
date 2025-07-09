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
    <title> LOGIN PARA HUMANOS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="/MODULO%202/UF-1%202/style.css" rel="stylesheet">
</head>

<body>
    <div>
        <h2>¿Cuánto es 5 + 9?</h2>
    </div>
    <br>
    <?php if ($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php">
        <label for="respuesta">Respuesta:</label><br>
        <input type="number" name="respuesta" required><br><br>
        <input type="submit" value="Entrar">
    </form>
</body>

</html>

<!--Para un sistema de login queremos poner una prueba para 
detectar que el usuario es un humano. Le pedimos que ingrese el resultado de 5+9.
 Si el resultado ingresado es correcto, puede entrar, si no, se muestra un mensaje de error
 y volvemos a mostrarle el formulario.

Dos páginas:
- inicio.php. Login
- contenido.php . Imagen (que solo puede ver el usuario que ha acertado).*/
-->