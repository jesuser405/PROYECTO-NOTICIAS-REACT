<?php 
session_start();
if (isset($_GET['logout']) === true) {
    session_destroy();
    header('location: ./'); // A la raiz del directorio
}