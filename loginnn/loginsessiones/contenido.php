<?php
session_start();

define("userCorrecto", "admin");
define("emailCorrecto", "104cubes@gmail.com");

// Procesar datos recibidos desde index.php (al iniciar sesión)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nombre"]) && isset($_POST["mail"])) {
    $nombre = trim($_POST["nombre"]);
    $mail = trim($_POST["mail"]);

    if ($nombre !== "" && $mail !== "") {
        $_SESSION['nombre'] = htmlspecialchars($nombre);
        $_SESSION['email'] = htmlspecialchars($mail);
    }
}

// Verificar que la sesión esté activa
if (!isset($_SESSION['email']) || !isset($_SESSION['nombre'])) {
    header("Location: index.php");
    exit();
}

// Cerrar sesión
if (isset($_POST['cerrar_sesion'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
</head>
<body>
    <h1>Bienvenido <?php echo htmlspecialchars($_SESSION["nombre"]); ?></h1>

    <form method="post">
        <button type="submit" id="boton" name="cerrar_sesion">Cerrar sesión</button>
    </form>
</body>
</html>
