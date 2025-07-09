<?php
require_once "functions.php";
require_once "conexion.php";
define('uploads_dir', 'uploads');
$tituloErr = $user_idErr = $categoriaErr = $descripcionErr = $insertaErr = $fotoErr = "";
// Inicializamos las variables de error
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Noticia</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>

<body>
    <?php require_once "partials/header.php"; ?>
    <div id="main">
        <h1 class="success"><?= $insertaSuccess ?></h1>
        <h1 class="error"><?= $insertaErr ?></h1>
        <h1>AÑADIR <?= $otra ?> NOTICIA</h1>
        <form action="anadir_noticia.php" method="POST" enctype="multipart/form-data">

            <label for="titulo">Título de la noticia:</label>
            <input type="text" name="titulo" id="titulo" value="<?php echo $titulo; ?>">
            <span class="error">* <?php echo $tituloErr; ?></span>
            <br>
            <label for="user_id">Autor:</label>
            <input type="number" name="user_id" id="user_id" value="2" readonly>
            <span class="error">* <?php echo $user_idErr; ?></span>
            <br>
            <label for="categoria">Categoría:</label>
            <select name="categoria" id="categoria">
                <option value="Noticias">Noticias</option>
                <option value="Curiosidades">Curiosidades</option>
                <option value="Deportes">Deportes</option>
            </select>
            <br>
            Elige una imagen:<br>
            <span class="error">* <?php echo $fotoErr; ?></span>
            <input type="file" name="foto" id="foto" accept="image/*">
            <br>
            <label for="descripcion">Descripcion:</label>
            <textarea name="descripcion" id="descripcion" placeholder="Contenido de la noticia">
                <?php echo $descripcion; ?>
            </textarea>
            <span class="error">* <?php echo $descripcionErr; ?></span>
            <br><br>
            <input type="submit" value="Enviar">
        </form>
    </div>
    <?php require_once "partials/footer.php"; ?>
</body>

</html>