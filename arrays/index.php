<?php
$estudiantes = array(
    array(
        "nombre" => "Jesus",
        "edad" => 20,
        "notas" => array(10, 9, 8),
    ),
    array(
        "nombre" => "Juan",
        "edad" => 22,
        "notas" => array(7, 8, 9),
    ),
    array(
        "nombre" => "Pedro",
        "edad" => 21,
        "notas" => array(10, 9, 8),
    ),
    array(
        "nombre" => "Maria",
        "edad" => 23,
        "notas" => array(7, 8, 9),
    )
);

echo "<h2> La edad de Maria es ".$estudiantes[3]['edad']."</h2>";
echo "El nombre de todos los estudiantes es :<br>";

foreach($estudiantes as $estudiante){
    echo $estudiante['nombre']."<br>";
}

$notasJesus = $estudiantes[0]['notas'];

$mediaNotaJesus = array_sum($notasJesus) / count($notasJesus);
echo "<h2> La media de las notas de Jesus es ".$mediaNotaJesus."</h2>";