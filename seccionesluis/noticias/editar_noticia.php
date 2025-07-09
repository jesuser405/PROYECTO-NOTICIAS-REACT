<?php
require_once "sesiones.php";
require_once "functions.php";
require_once "conexion.php";
define('uploads_dir', 'uploads');
$titulo = $user_id = $categoria = $descripcion = $insertaSuccess = $id = "";
$errorGenerl = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id'])) {
    
    if (!isset($_POST["id"]) || empty($_POST["id"])) {

        http_response_code(400); // Faltan parámetros.
       
        $errorGenerl = "No hay ID";
        
    } else {
        /*  if (!preg_match("/^[a-zA-Z-' ]*$/", $titulo)) {
            $nombreErr = "Introduce solo letras mayúsculas o minúsculas";
        }*/
        $id = test_input($_POST["id"]);
    }
    if (!isset($_POST["titulo"]) || empty($_POST["titulo"])) {

        http_response_code(400); // Faltan parámetros.

        $errorGenerl = "Título ausente";
    } else {
        /*  if (!preg_match("/^[a-zA-Z-' ]*$/", $titulo)) {
            $nombreErr = "Introduce solo letras mayúsculas o minúsculas";
        }*/
        $titulo = test_input($_POST["titulo"]);
    }
    if (!isset($_POST["user_id"]) || empty($_POST["user_id"])) {

        $errorGenerl = true;
    } else {
        /*    if (!filter_var($user_id, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Tienes que introducir un email válido";
        }*/
        $user_id = test_input($_POST["user_id"]);
    }

    if (!isset($_POST["categoria"]) || empty($_POST["categoria"])) {
    
        $errorGenerl = "Categoría";
    } else {
        /*    if (!filter_var($categoria, FILTER_VALIDATE_URL)) {
            $categoriaErr = "Tienes que introducir una categoria válido";
        }*/
        $categoria = test_input($_POST["categoria"]);
    }
    if (!isset($_POST["descripcion"]) || empty($_POST["descripcion"])) {
   
        $errorGenerl = "error en la descripción";
    } else {
        /*   if (!filter_var($enlace, FILTER_VALIDATE_URL)) {
            $descripcionErr = "Tienes que introducir un descripcion válido";
        }*/
        $descripcion = test_input($_POST["descripcion"]);
    }
    $foto = $_POST["fotoAntigua"];
    if ($_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE) {
        $foto = $_FILES["foto"];
        $rutaTemporal = $foto['tmp_name'];
        $foto = uploads_dir . "/" . uniqid() . "-" . basename($foto['name']);
        if (!is_dir(uploads_dir)) mkdir(uploads_dir); // Creamos el directorio si no existe
        
        if (!move_uploaded_file($rutaTemporal, $foto)){
            
            $errorGenerl = "Hubo algún error al subir la imagen";
        }
    }
    if (!$errorGenerl) {
        try {
            $query = "UPDATE noticias SET titulo = ?, descripcion = ?, categoria = ?, user_id = ?, foto = ?
                        WHERE 
                        id = ?
                     ";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$titulo, $descripcion, $categoria, $user_id, $foto, $id]);
            // Variable declarada al principio como "
            $titulo = $user_id = $categoria = $descripcion = "";
        } catch (Exception $e) {
            // Variable declarada al principio como ""
          
            $errorGenerl = $e;
        }
    }
} else{
    $errorGenerl = "No puedes realizar esta acción";
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($noticia['titulo'] ?? 'Noticia no encontrada'); ?></title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>

<body>
    <?php require_once "partials/header.php";?>
<?php 
    if (!$errorGenerl) { 
        echo "<h1 style='color:green'>Noticia modificada con éxito</h1>";
        sleep(4);
        header( 'loction: noticia.php?id=' .$id);
        echo "<br><a href='noticia.php?id=$id'>Ir a la noticia</a>";

    } else {
        echo "<h1 style='color:red'>Hubio algún error:</h1> " .$errorGenerl;
  
        echo "<a href='#' onclick='javascript:history.back()' style='display:none'>Ir a la noticia</a>";
    }


?>
       
<?php require_once "partials/header.php";?>
</body>

</html>