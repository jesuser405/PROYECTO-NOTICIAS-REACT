<?php
session_start();

// Si no pasó la prueba, redirigir al login
if (!isset($_SESSION['acceso']) || $_SESSION['acceso'] !== true) {
  header("Location: /MODULO 2/UF-1 2/index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Contenido Restringido</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link href="/MODULO%202/UF-1%202/style.css" rel="stylesheet">

</head>

<body>
  <div>
    < <h2>🎉 ¡Bienvenido, humano! </h2>
  </div>

  <p>Has pasado la prueba. Aquí tienes tu imagen secreta:</p> <br>

  <div><img src="img.png" alt="Imagen para humanos"><br> </div>

  <p><a href="close.php">Cerrar sesión</a></p><br>

</body>

</html>