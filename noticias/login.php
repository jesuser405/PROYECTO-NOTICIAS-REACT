<?php
// Incluye archivos necesarios para funciones generales y conexión a la base de datos
if (isset($_SESSION['id'])) header('location: index.php');
require_once "funciones_generales.php";
require_once "conexion.php";

// Variable para almacenar mensajes de error generales
$errorGeneral = "";

// Verifica si la petición es POST (formulario enviado)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica si se recibieron los campos 'email' y 'password'
    if (isset($_POST['password']) && isset($_POST['email'])) {
        $email = $_POST['email'];
        $pass = $_POST['password'];

        // Prepara y ejecuta la consulta para buscar el usuario por email
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si no existe el usuario, muestra error y sugiere registrarse
        if (!$user) {
            http_response_code(404);
            $errorGeneral = "No esxiste el usuario, <a href='registro.php'>regístrese</a>";
        } else {
            // Verifica si la contraseña es correcta (comparación directa, no segura)
            if (!password_verify($pass, $user['password'])) {
                http_response_code(401);
                $errorGeneral = "Credenciales icncorrectas, inténtelo de nuevo " . password_hash($pass, PASSWORD_DEFAULT) . ' - ' . $user['password'];
            } else {
                $_SESSION['nombre'] = $user['nombre'];
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                header('location: index.php');
            }
        }
    } else {
        // Si faltan parámetros obligatorios, muestra error
        http_response_code(400);
        echo "Faltan parámetros";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesiones Login</title>
    <link rel="stylesheet" href="CSS/css.css">
</head>

<body>
    <?php require_once "partials/header.php"; ?>
    <!-- Muestra mensaje de error general si existe -->
    <span class="error"><?php echo $errorGeneral; ?></span>
    <h1>LOGIN</h1>

    <!-- Formulario de login -->
    <form action="login.php" method="post">
        Email: <br>
        <input type="text" name="email"><br>
        Password: <br>
        <input type="password" name="password"><br>
        <input type="submit">
    </form>
</body>

</html>