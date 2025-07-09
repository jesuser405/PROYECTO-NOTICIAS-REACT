<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fehca Hoy</title>
    <style>
        :root {
            color-scheme: dark;
        }

        body {
            display: grid;
            place-content: center;
        }
    </style>
</head>

<body>
    <?php
    date_default_timezone_set('Europe/Madrid');
    $fecha = new DateTime();
    $fmt = new IntlDateFormatter('es_ES', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
    echo $fmt->format($fecha); // Ejemplo: "martes, 14 de mayo de 2025"
    echo date("h:i:s a"); // Ejemplo: "martes, 14 de mayo de 2025 12:00:00"
    // Establecemos la localización a español de España
    /* echo "<h1> Bienvenido </h1>";
    echo "<h1>La fecha y hora de hoy es: " . date('%A, %d de %B de %Y %H:%M:%S') . "</h1>";
    echo "<h1>En Canarias son las: " . date('%A, %d de %B de %Y %H:%M:%S', time() - 3600) . "</h1>";
    */
    ?>

</body>

</html>