<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Basico</title>
</head>

<body>

    <!-- Formulario básico con método POST -->
    <form id="form" action="holanombre.php" method="POST">
        Name: <input type="text" name="name" value=""><br> <!-- Campo para el nombre -->
        E-mail: <input type="text" name="email"><br> <!-- Campo para el email -->
        <input type="submit"> <!-- Botón de envío -->
    </form>

    <?php
    // Verifica si la solicitud es de tipo POST
    if ($_SERVER['REQUEST_METHOD'] == "POST") { ?>
        <!-- Mensaje de bienvenida y muestra los datos enviados -->
        Welcome
        Your name is:
        <?php echo $_POST["name"] ?><br> <!-- Muestra el nombre ingresado -->
        Your email address is:
        <?php echo $_POST["email"]; ?> <!-- Muestra el email ingresado -->
    <?php } else {
        // Mensaje para cuando no se ha enviado el formulario
        echo "Cubre el formulario";
    }
    ?>

</body>

</html>