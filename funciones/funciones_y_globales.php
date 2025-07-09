<?php
       $nombre="Pablo";
       $apellido="Picapiedra";
       $edad = 36;

   function escribe(){
       global $nombre, $apellido, $edad;
       echo "<h1>Hola $nombre $apellido</h1>
       <h2>Tu edad: $edad<h2>";
   }
   escribe();
   exit;
    //Ejemplo de una funcion que recibe un array y devuelve la suma de sus elementos
    