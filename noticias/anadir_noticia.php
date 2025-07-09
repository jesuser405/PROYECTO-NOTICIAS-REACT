<?php
// Incluye la conexión a la base de datos y funciones generales
require_once "conexion.php";
require_once "funciones_generales.php";
require_once "sessiones.php";
if (!isset($_SESSION['id'])) {
    header('location: login.php');
}
// Define la constante 'uploads_dir' para almacenar archivos subidos
define('uploads_dir', 'uploads');

// Inicializa mensajes de error y éxito
$tituloErr = $user_idErr = $categoriaErr = $descripcionErr = $insertaErr = $fotoErr = "";
$titulo = $user_id = $categoria = $descripcion = $insertaSuccess = $foto = "";
$otra = "";
$errorGenerl = false;

// Comprueba si la petición es POST (envío del formulario)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valida y procesa la foto subida
    if (!isset($_FILES["foto"])) {
        $user_idErr = "Tienes que subir una foto";
        $errorGenerl = true;
    } else {
        $foto = $_FILES["foto"];
        $archivo = $foto["tmp_name"];
        $foto_nombre = uniqid() . "-" . basename($foto["name"]);
        $foto_ruta = uploads_dir . "/" . $foto_nombre;

        // Crea el directorio 'uploads' si no existe
        if (!is_dir(uploads_dir)) mkdir(uploads_dir);

        // Mueve el archivo subido al directorio 'uploads'
        if (!move_uploaded_file($archivo, $foto_ruta)) {
            $fotoErr = "Error al subir la foto";
            $errorGenerl = true;
        }
        $foto = $foto_ruta;
    }

    // Valida el campo 'titulo'
    if (!isset($_POST["titulo"]) || empty($_POST["titulo"])) {
        http_response_code(400); // Devuelve HTTP 400 si faltan parámetros
        $tituloErr = "Tienes que introducir un nombre";
        $errorGenerl = true;
    } else {
        $titulo = test_input($_POST["titulo"]);
    }

    // Valida el campo 'user_id'
    if (!isset($_POST["user_id"]) || empty($_POST["user_id"])) {
        $user_id = $_SESSION['id'];
        $user_idErr = "Tienes que introducir un user_id";
        $errorGenerl = true;
    } else {
        $user_id = test_input($_POST["user_id"]);
    }

    // Valida el campo 'categoria'
    if (!isset($_POST["categoria"]) || empty($_POST["categoria"])) {
        $categoriaErr = "Tienes que introducir una categoria";
        $errorGenerl = true;
    } else {
        $categoria = test_input($_POST["categoria"]);
    }

    // Valida el campo 'descripcion'
    if (!isset($_POST["descripcion"]) || empty($_POST["descripcion"])) {
        $descripcionErr = "Tienes que introducir algún texto";
        $errorGenerl = true;
    } else {
        $descripcion = test_input($_POST["descripcion"]);
    }

    // Si no hay errores, inserta los datos en la base de datos
    if (!$errorGenerl) {
        try {
            // Prepara la consulta SQL para insertar la noticia
            $stmt = $pdo->prepare(
                "INSERT INTO noticias (titulo, descripcion, categoria, user_id, foto) 
     VALUES (?, ?, ?, ?, ?)"
            );
            // Ejecuta la consulta con los datos validados
            $stmt->execute([$titulo, $descripcion, $categoria, $user_id, $foto]);

            // Mensaje de éxito
            $insertaSuccess = "Noticia insertada con éxito";
            $otra = "OTRA";
            $titulo = $user_id = $categoria = $descripcion = "";
        } catch (Exception $e) {
            // Mensaje de error
            $insertaErr = "No se ha podido ingresar la noticia en la BBDD " . $e;
        }
    }
}

// Función para sanear datos de entrada

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Noticia</title>
    <link rel="stylesheet" href="CSS/css.css">
</head>

<body>
    <?php require_once "partials/header.php"; ?>
    <div id="main">
        <!-- Muestra mensajes de éxito o error -->
        <h1 class="success"><?= $insertaSuccess ?></h1>
        <h1 class="error"><?= $insertaErr ?></h1>
        <h1>AÑADIR <?= $otra ?> NOTICIA</h1>

        <!-- Formulario para añadir una noticia -->
        <form action="anadir_noticia.php" method="POST" enctype="multipart/form-data">
            <label for="titulo">Título de la noticia:</label>
            <input type="text" name="titulo" id="titulo" value="<?php echo $titulo; ?>">
            <span class="error">* <?php echo $tituloErr; ?></span>
            <br>

            <label for="user_id">Autor:</label>
            <input type="hidden" name="user_id" value="<?= $_SESSION['id'] ?>">
            <p><strong>Autor ID:</strong> <?= $_SESSION['id'] ?></p>

            <span class="error">* <?php echo $user_idErr; ?></span>
            <br>

            <label for="categoria">Categoría:</label>
            <select name="categoria" id="categoria">
                <?php
                try {
                    $stmt = $pdo->prepare("SELECT DISTINCT categoria FROM noticias");
                    $stmt->execute();
                    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($categorias as $categoriaBD) {
                        $selected = "";
                        echo $categoriaBD['categoria'] . ' - ' . $noticia['categoria'];
                        if ($categoriaBD['categoria'] == $noticia['categoria']) {
                            $selected = "selected";
                        }
                        echo "<option value='" . $categoriaBD['categoria'] . "' $selected>" . $categoriaBD['categoria'] . "</option>";
                    }
                } catch (Exception $e) {
                    echo $e;
                }
                ?>
            </select>
            <span class="error">* <?php echo $categoriaErr; ?></span>
            <br>

            <label for="foto">Foto:</label>
            <input type="file" name="foto" accept="image/*">
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
</body>
<?php require_once "partials/footer.php"; ?>

</html>