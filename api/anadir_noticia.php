<?php

require_once "functions.php";
require_once "conexion.php";

define('uploads_dir', './uploads');
$tituloErr = $user_idErr = $categoriaErr = $descripcionErr = $insertaErr = $fotoErr = "";

$titulo = $user_id = $categoria = $descripcion = $insertaSuccess = $foto = "";
$otra = "";
$errorGenerl = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES["foto"])) {
        $foto = $_FILES["foto"];
        $rutaTemporal = $foto['tmp_name'];
        $foto = uploads_dir . "/" . uniqid() . "-" . basename($foto['name']);
        if (!is_dir(uploads_dir)) mkdir(uploads_dir); // Creamos el directorio si no existe
        
        if (!move_uploaded_file($rutaTemporal, $foto)){
            $fotoErr = "Hubo algún error al subir la imagen";
            $errorGenerl = true;
        }
    }
    if (!isset($_POST["titulo"]) || empty($_POST["titulo"])) {

        http_response_code(400); // Faltan parámetros.
        $tituloErr = "Tienes que introducir un nombre";
        $errorGenerl = true;
    } else {
        /*  if (!preg_match("/^[a-zA-Z-' ]*$/", $titulo)) {
            $nombreErr = "Introduce solo letras mayúsculas o minúsculas";
        }*/
        $titulo = test_input($_POST["titulo"]);
    }
    if (!isset($_POST["user_id"]) || empty($_POST["user_id"])) {
        $user_idErr = "Tienes que introducir un user_id";
        $errorGenerl = true;
    } else {
        /*    if (!filter_var($user_id, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Tienes que introducir un email válido";
        }*/
        $user_id = test_input($_POST["user_id"]);
    }

    if (!isset($_POST["categoria"]) || empty($_POST["categoria"])) {
        $categoriaErr = "Tienes que introducir una categoria";
        $errorGenerl = true;
    } else {
        /*    if (!filter_var($categoria, FILTER_VALIDATE_URL)) {
            $categoriaErr = "Tienes que introducir una categoria válido";
        }*/
        $categoria = test_input($_POST["categoria"]);
         if (!isset($_FILES["foto"])) {
            $foto = 'uploads/'.$categoria.'.jpg';
         }
    }
    if (!isset($_POST["descripcion"]) || empty($_POST["descripcion"])) {
        $textareErr = "Tienes que introducir algún texto";
        $errorGenerl = true;
    } else {

        $descripcion = test_input($_POST["descripcion"]);
    }

    if (!$errorGenerl) {
        try {

            $stmt = $pdo->prepare(
                "INSERT INTO noticias (titulo, descripcion, categoria, user_id, foto) 
        VALUES (?, ?, ?, ?, ?)"
            );
            $stmt->execute([$titulo, $descripcion, $categoria, $user_id, $foto]);
            // Variable declarada al principio como ""
            $insertaSuccess = "Noticia insertada con éxito";
            $otra = "OTRA";
            $titulo = $user_id = $categoria = $descripcion = "";
        } catch (Exception $e) {
            // Variable declarada al principio como ""
            $insertaErr = "No se ha podido ingresar la noticia en la BBDD " . $e;
        }
    }
}