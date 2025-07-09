<?php
// Incluye archivos necesarios para la conexión, funciones y sesiones
require_once "conexion.php";
require_once "funciones_generales.php";


// Verifica si se ha pasado un ID por GET, si no, redirige al index
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('location: index.php');
}
$id = $_GET['id'];

// Prepara y ejecuta la consulta para obtener la noticia por ID
// ¡OJO! La consulta tiene un error: el JOIN no está bien formado
$stmt = $pdo->prepare("SELECT * FROM noticias JOIN usuarios ON noticias.user_id= usuarios.id WHERE noticias.id = ?");
$stmt->execute([$id]);
$noticia = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <!-- Título dinámico según la noticia -->
    <title><?php echo htmlspecialchars($noticia['titulo'] ?? 'Noticia no encontrada'); ?></title>
    <link rel="stylesheet" href="CSS/css.css">
</head>

<body>
    <?php require_once "partials/header.php"; ?>
    <div id="main">
        <div class="tarjeta">
            <?php if ($noticia): ?>
                <!-- Muestra los datos de la noticia -->
                <h1><?php echo htmlspecialchars($noticia['titulo']); ?></h1>
                <img src="<?php echo htmlspecialchars($noticia['foto']); ?>" alt="Imagen de la noticia" class="foto">
                <h2><?php echo htmlspecialchars($noticia['titulo']); ?></h2>
                <small>Categoría: <?php echo htmlspecialchars($noticia['categoria']); ?> - Fecha:
                    <?php echo $noticia['fecha']; ?></small>
                <p><?php echo nl2br(htmlspecialchars($noticia['descripcion'])); ?></p>
                <small>Autor:</small>
                <p><?php echo $noticia['nombre']; ?></p>
            <?php else: ?>
                <!-- Si no existe la noticia -->
                <p>❌ Noticia no encontrada.</p>
            <?php endif; ?>
            <!-- Enlaces para volver y eliminar la noticia -->
            <a href="index.php">← Volver</a>
            <?php if (isset($_SESSION['id'])) { ?>
                <a href="eliminar_noticia.php?id=<?PHP echo $id; ?>&foto=<?php echo $noticia['foto']; ?>" onclick="return confirm('Esto eliminará definitivamente la noticia ¿Quieres continuar?')">❌ Eliminar noticia</a>
            <?php } ?>
        </div>

        <div id="form" class="tarjeta">
            <h1>EDITAR NOTICIA</h1>
            <!-- Formulario para editar la noticia -->
            <form action="editar_noticia.php" method="POST" enctype="multipart/form-data">
                <!-- Campo para el título -->
                <label for="titulo">Título de la noticia:</label>
                <input type="text" name="titulo" id="titulo" value="<?php echo $noticia['titulo']; ?>">
                <span class="error">* </span>
                <br>
                <!-- Campo para el autor (oculto, toma el id de sesión) -->
                <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['id']; ?>" readonly>
                <span class="error">* </span>
                <br>
                <!-- Selector de categoría -->
                <label for="categoria">Categoría:</label>
                <select name="categoria" id="categoria">
                    <?php
                    // Obtiene las categorías distintas de la base de datos
                    try {
                        $stmt = $pdo->prepare("SELECT DISTINCT categoria FROM noticias");
                        $stmt->execute();
                        $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($categorias as $categoriaBD) {
                            $selected = "";
                            // Marca como seleccionada la categoría actual de la noticia
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
                <br>
                <!-- Área de texto para la descripción -->
                <label for="descripcion">Descripcion:</label>
                <textarea name="descripcion" id="descripcion" placeholder="Contenido de la noticia">
                    <?php echo $noticia['descripcion']; ?>
                </textarea>
                <!-- Campo oculto con el ID de la noticia -->
                <input type="hidden" name="id" value="<?= $noticia['id']; ?>">
                <!-- Campo para subir una nueva foto -->
                <input type="file" name="foto" accept="image/*" id="foto">
                <br>
                <!-- Campo oculto con la foto antigua -->
                <input type="hidden" name="fotoAntigua" value="<?= $noticia['foto']; ?>">
                <span class="error">* </span>
                <br><br>
                <!-- Botón para enviar el formulario -->
                <input type="submit" value="Enviar">
            </form>
        </div>
    </div>
</body>
<?php require_once "partials/footer.php"; ?>

</html>