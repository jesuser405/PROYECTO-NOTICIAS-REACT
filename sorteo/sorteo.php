<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorteo PHP</title>
</head>

<body>
    <h1>SORTEO</h1>
    <?php
    // Definimos la cantidad de premios a sortear (en este caso, 1 ganador)
    define('cantidadPremios', 3);

    // Lista de concursantes
    $concursantes = [
        'Pedro',
        'Ana',
        'María',
        'Alfredo',
        'Amelia',
        'Roi',
        'Roque'
    ];

    // Array para almacenar los índices de los ganadores
    $ganadores = [];

    // Función recursiva para realizar el sorteo
    function sortear($cantidadConcursantes, $cantidadPremios)
    {
        global $ganadores; // Accedemos a la variable global $ganadores

        // Si ya se han seleccionado todos los ganadores, terminamos la función
        if (count($ganadores) == $cantidadPremios) return;

        // Seleccionamos un ganador aleatorio (índice del array de concursantes)
        $ganador = rand(0, $cantidadConcursantes);

        // Verificamos si el ganador ya fue seleccionado
        if (!in_array($ganador, $ganadores)) {
            // Si no ha sido seleccionado, lo añadimos al array de ganadores
            array_push($ganadores, $ganador);
        }

        // Llamamos recursivamente a la función hasta completar la cantidad de premios
        sortear($cantidadConcursantes, $cantidadPremios);
    }

    // Llamamos a la función sortear con la cantidad de concursantes y premios
    sortear(count($concursantes) - 1, cantidadPremios);

    // Mostramos los nombres de los ganadores
    foreach ($ganadores as $ganador) {
        echo "<h3> Ganador: " . $concursantes[$ganador]  . "</h3>";
    }
  /*  class Ganador
    {
        public $name;
        public $age;

        function __construct($name, $age)
        { {
                $this->name = $name;
                $this->age = $age;
            }
        }
    }
$my_class = new $ganador("Jesus", 25);
print_r($my_class);
    // Mostramos el array de ganadores
    echo $my_class -> name;
    */
    ?>
</body>

</html>