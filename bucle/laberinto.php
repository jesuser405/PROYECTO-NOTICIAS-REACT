<?php
$laberinto = array(
    array("#", "#", "#","#", "#"),
    array("#", ".", ".", ".", "#"),
    array("#", ".", "#", ".", "#"),
    array("#", ".", "#", ".", "#"),
    array("#", ".", ".", ".", "#"),
);

$punto=0;
foreach($laberinto as $fila) { //recorre el array
    foreach ($fila as $celda){
        if($celda == "."){
            $punto++;
        }
    }

}
echo "La cantidad de puntos es: ".$punto."<br>";