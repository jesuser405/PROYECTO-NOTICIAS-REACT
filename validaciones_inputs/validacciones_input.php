<?php
// Definir variables y establecer valores por defecto
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["name"]) || empty($_POST["name"])) {
        http_response_code(400); // Faltan parámetros.
        $nameErr = "El nombre es obligatorio";
    } else {
        $name = test_input($_POST["name"]);
    }

    if (!isset($_POST["email"]) || empty($_POST["email"])) {
        $emailErr = "El email es obligatorio";
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["website"])) {
        $website = "";
    } else {
        $website = test_input($_POST["website"]);
    }

    if (empty($_POST["comment"])) {
        $comment = "";
    } else {
        $comment = test_input($_POST["comment"]);
    }

    /*
    if (empty($_POST["gender"])) {
        $genderErr = "El género es obligatorio";
    } else {
        $gender = test_input($_POST["gender"]);
    }
    */
}

// Función para sanear entradas
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Validación</title>
    <style>
        .error { color: red; }
    </style>
</head>
<body>

<h2>Formulario de Validación</h2>
<p><span class="error">* campo obligatorio</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Nombre: <input type="text" name="name" value="<?php echo $name; ?>">
    <span class="error">* <?php echo $nameErr; ?></span>
    <br><br>

    Correo electrónico: <input type="text" name="email" value="<?php echo $email; ?>">
    <span class="error">* <?php echo $emailErr; ?></span>
    <br><br>

    Página web: <input type="text" name="website" value="<?php echo $website; ?>">
    <span class="error"><?php echo $websiteErr; ?></span>
    <br><br>

    Comentario: <textarea name="comment" rows="5" cols="40"><?php echo $comment; ?></textarea>
    <br><br>

    <!-- Género (opcional, descomentarlo si lo quieres usar)
    Género:
    <input type="radio" name="gender" value="female" <?php if (isset($gender) && $gender == "female") echo "checked"; ?>>Femenino
    <input type="radio" name="gender" value="male" <?php if (isset($gender) && $gender == "male") echo "checked"; ?>>Masculino
    <span class="error">* <?php echo $genderErr; ?></span>
    <br><br>
    -->

    <input type="submit" name="submit" value="Enviar">
</form>

<?php
// Mostrar datos si no hay errores
if ($_SERVER["REQUEST_METHOD"] == "POST" && $nameErr == "" && $emailErr == "") {
    echo "<h3>Datos recibidos:</h3>";
    echo "<strong>Nombre:</strong> $name<br>";
    echo "<strong>Email:</strong> $email<br>";
    echo "<strong>Web:</strong> $website<br>";
    echo "<strong>Comentario:</strong> $comment<br>";
    // echo "<strong>Género:</strong> $gender<br>";
}
?>

</body>
</html>
