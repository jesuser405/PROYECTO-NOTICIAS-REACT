<?php

require_once "funciones_generales.php"; // Incluye funciones generales
require_once "conexion.php"; // Incluye la conexión a la base de datos
$errorGeneral = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Si el formulario fue enviado por POST
    if (isset($_POST['password']) && isset($_POST['email']) && isset($_POST['repeatpassword']) && isset($_POST['nombre'])) {
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $repeatpass = $_POST['repeatpassword'];
        if ($pass != $repeatpass) { // Verifica si las contraseñas coinciden
            http_response_code(403);
            $errorGeneral = "No coinciden";
            exit;
        }
        $pass = password_hash($pass, PASSWORD_DEFAULT); // Hashea la contraseña
        $nombre = $_POST['nombre'];
        try {
            // Inserta el nuevo usuario en la base de datos
            $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$nombre, $email, $pass]);
            header('location: login.php'); // Redirige al login tras el registro
        } catch (Exception $e) {
            http_response_code(500);
            $errorGeneral = "Hubo algún problema al insertar el usuario: " . $e;
        }
    } else {
        http_response_code(400);
        $errorGeneral = "Faltan parámetros obligatorios";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesiones Login</title>
    <link rel="stylesheet" href="CSS/css.css"> <!-- Enlaza la hoja de estilos CSS -->
</head>

<body>
    <?php require_once "partials/header.php"; // Incluye el header ?>
    <span style="color:red;"><?php echo htmlspecialchars($errorGeneral); // Muestra errores ?></span>
    <h1>REGISTRO DE USUARIO</h1>

    <form action="registro.php" method="post">
        Email: <br>
        <input type="text" name="email"><br>
        Nombre: <br>
        <input type="text" name="nombre"><br>
        Password: <br>
        <input type="password" name="password"><br>
        Repite Password: <br>
        <input type="password" name="repeatpassword"><br>
        <input type="submit">
    </form>
</body>

</html>