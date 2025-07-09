<?php
//1.- Crear un array llamado $estudiantes con al menos 5 estudiantes con diferentes nombres, edades y notas.
// Creando las arrays con los nombres
$estudiantes = array (
    array("nombre" => "Julian", "edad" => 19, "nota" => 6.5),
    array("nombre" => "Andrea", "edad" => 20, "nota" => 5.8),
    array("nombre" => "Mario", "edad" => 27, "nota" => 10),
    array("nombre" => "Juana", "edad" => 25, "nota" => 5.0),
    array("nombre" => "Lucía", "edad" => 22, "nota" => 3.9)
);

//2.- Mostrar la lista completa de estudiantes con sus datos.
//Creando el listado de estudantes
echo "<h1>Listado de estudiamtes</h1>";
foreach ($estudiantes as $estudiante){
    echo "Nombre: " . $estudiante["nombre"] . ", Edad: " . $estudiante["edad"] . ", Nota: " . $estudiante["nota"] . "<br>";

}
//3.- Mostrar los nombres de los estudiantes que han aprobado, considerando aprobado si nota ≥ 5.
// Definiendo la nota que validara cual es el aprovado 
print_r("<h1>Estudiantes aprobados</h1>");
foreach ($estudiantes as $estudiante){
    if ($estudiante["nota"]>=5){
        echo $estudiante["nombre"] . "<br>";
    }
}

//5.- Opcional:¿Te atreves a hacer el script para mostrar la nota más alta y la más baja?
// Definiendo la nota maxima y minima
$notas = array_column($estudiantes, "nota");
$nota_maxima = max($notas);
$nota_minima = min($notas);

echo "<h2>Nota más alta:</h2>";
echo $nota_maxima . "<br>";

echo "<h2>Nota más baja:</h2>";
echo $nota_minima . "<br>";

