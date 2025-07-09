<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    $nombre = "Jesus";
    $apellido = "Ortiz";
    $edad = 29;
    $ciudad_natal = "Cali";

    echo "<p style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
        Hola, me llamo <strong>$nombre $apellido</strong>,<br>
        Tengo <strong>$edad</strong> años,<br>
        y soy de <strong>$ciudad_natal</strong>.
    </p>";
    ?>
    <h1>Hola Mundo HTML</h1>
    Hola, me llamo <?php echo $nombre . $apellido; ?> <br> Tengo <?php  echo $edad; ?> <br>
    años y soy de <?php echo $ciudad_natal; ?> que es una ciudad facinante para visitar<br>
    
    <h1>Fin mundo</h1>
    <?php echo file_get_contents("https://www.elpais.com"); ?>
    ?>
</body>
</html>