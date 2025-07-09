<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constantes Variables</title>
</head>
<body>
    <?php
    // Definimos una constante
    define('nombre', 'Jesus');
    $edad = 25;

    function imprimir ()
    {
        global $edad;
        // Accedemos a la constante definida fuera de la función
        
        echo "Hola soy " .nombre . " y tengo " .$edad . "años";
    }
    // Llamamos a la función
    imprimir();
?>

</body>
</html>