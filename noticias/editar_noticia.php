<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
//Editar 

require_once "conexion.php"; // Incluye el archivo de conexión a la base de datos
require_once "funciones_generales.php"; // Incluye las funciones generales
require_once "sessiones.php"; // Incluye el archivo de sesiones para manejar la sesión del usuario
define('uploads_dir', 'uploads');

// Inicialización de variables
$titulo = $user_id = $categoria = $descripcion = $insertaSuccess = $id = "";
$errorGenerl = false;


// Verifica si la petición es POST 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id'])) {


    // Validación del campo 'id'
    if (!isset($_POST["id"]) || empty($_POST["id"])) {
       
            http_response_code(400); // Faltan parámetros.

            $errorGenerl = "No hay ID";
        } else {
            $id = test_input($_POST["id"]);
        }

        // Validación del campo 'titulo'
        if (!isset($_POST["titulo"]) || empty($_POST["titulo"])) {

            http_response_code(400); // Faltan parámetros.

            $errorGenerl = "Falta Título";
        } else {
            $titulo = test_input($_POST["titulo"]);
        }

        // Validación del campo 'user_id'
        if (!isset($_POST["user_id"]) || empty($_POST["user_id"])) {

            $errorGenerl = true;
        } else {
            $user_id = test_input($_POST["user_id"]);
        }


        // Validación del campo 'categoria'
        if (!isset($_POST["categoria"]) || empty($_POST["categoria"])) {

            $errorGenerl = "categoría";
        } else {
            $categoria = test_input($_POST["categoria"]);
        }

        // Validación del campo 'descripcion'
        if (!isset($_POST["descripcion"]) || empty($_POST["descripcion"])) {
            echo 5; // Código de error
            $errorGenerl = true;
        } else {
            $descripcion = test_input($_POST["descripcion"]);
        }

        if (isset($_POST["fotoAntigua"])) {
            echo "Foto Antigua";
            $foto = $_POST["fotoAntigua"];
        }

        // Si no se sube una nueva foto, se usa la foto antigua
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            echo "Foto nueva";
            // Validación del archivo de foto
            $foto = $_FILES["foto"];
            $archivo = $foto["tmp_name"];
            $foto_nombre = uniqid() . "-" . basename($foto["name"]);
            $foto_ruta = uploads_dir . "/" . $foto_nombre;

            // Create the 'uploads' directory if it doesn't exist
            if (!is_dir(uploads_dir)) mkdir(uploads_dir);
            try {
                move_uploaded_file($archivo, $foto_ruta);
                $foto = $foto_ruta;
            } catch (Exception $e) {

                $fotoErr = "Error al subir la foto: $e";
                $errorGenerl = true;
                echo $e;
            }
        }


        // Si no hay errores, realiza la actualización en la base de datos
        if (!$errorGenerl) {
            try {
                $query = "UPDATE noticias SET titulo = ?, descripcion = ?, categoria = ?, user_id = ?, foto = ? 
                        WHERE 
                        id = ?
                    ";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$titulo, $descripcion, $categoria, $user_id, $foto, $id]);
                // Limpia las variables después de la actualización
                $titulo = $user_id = $categoria = $descripcion = "";
            } catch (Exception $e) {
                // Muestra el error si ocurre una excepción
                echo $e;
                $errorGenerl = true;
            }
        }
    }

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($noticia['titulo'] ?? 'Noticia no encontrada'); ?></title>
    <link rel="stylesheet" href="CSS/css.css">

</head>

<body>
    <?php require_once "partials/header.php"; ?>
    <?php
    // Mensaje de éxito o error según el resultado
    if (!$errorGenerl) {
        echo "<h1 style='color:green'>Noticia modificada con éxito</h1>";
        sleep(4); // Espera 4 segundos antes de redirigir
        //header("location: noticia.php?id=" . $id);
        exit; // Muy importante detener la ejecución después del header
    } else {
        echo "<h1 style='color:green'>Hubio algún error en los datos, vuelva a la noticia para editar";
        echo "<a href='#' onclick='javascript:history.back()' style='display:none'>Ir a la noticia</a>";
    }
    ?>
</body>
<?php require_once "partials/footer.php"; ?>

</html> 