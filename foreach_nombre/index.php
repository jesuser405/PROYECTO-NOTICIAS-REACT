<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $nombres = array("Jesus", "Juan", "Pedro", "Maria", "Ana", "Luis", "Carlos", "Laura", "Sofia", "Diego");
    $varibble = 1;
    foreach ($nombres as $nombre) {
        $nombreEnMinisculas = strtolower($nombre); // Convertir a minúsculas
        if ($nombreEnMinisculas [0] == 'j') {
                echo "<br>Bienvenid@ $nombre $variable";
        } 
    } // Close the foreach loop

?>
</body>
</html>