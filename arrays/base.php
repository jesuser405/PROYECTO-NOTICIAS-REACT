<?php   

ini_set('display_errors', 1); // Mostrar errores
ini_set('display_startup_errors', 1); // Mostrar errores de inicio
error_reporting(E_ALL); // Reportar todos los errores

//Crear array
$colores = array("rojo", "verde", "azul", "amarillo", "naranja", "morado", "rosa");
//accedemos a "verde"
echo $colores[1]; // Imprime "verde"

//modificaciones verde por amarrillo
$colores[1] = "amarillo"; // Cambia "verde" a "amarillo"
//añadir
$colores[] = "gris"; // Añade "gris" al final del array
//eliminar "rojo"
array_splice($colores, 0, 1); // Elimina "rojo" (índice 0)
//imprimir array
print_r($colores); // Imprime el array completo
