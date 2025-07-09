<?php
 
$archivos = scandir('.');
 
foreach($archivos as $archivo){
    if (str_ends_with($archivo, '.php'))
    echo "<br><a href='$archivo'>$archivo</a>";
}
exit;