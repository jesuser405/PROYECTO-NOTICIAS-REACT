<?php

// Incluye funciones auxiliares y la conexión a la base de datos
require_once "functions.php";
require_once "conexion.php";

// Si no se recibe un ID válido por GET, redirige al índice
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('location: index.php');
}

// Obtiene el ID de la noticia desde la URL
$id = $_GET['id'];

// Prepara y ejecuta la consulta para obtener la noticia
$stmt = $pdo->prepare("SELECT * FROM noticias WHERE id = ?");
$stmt->execute([$id]);
$noticia = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <!-- Título dinámico según la noticia -->
    <title><?php echo htmlspecialchars($noticia['titulo'] ?? 'Noticia no encontrada'); ?></title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
    <?php require_once "partials/header.php"; ?>
    <div id="main">
        <div class="tarjeta">
            <?php if ($noticia): ?>
                <!-- Muestra la noticia -->
                <h1><?php echo htmlspecialchars($noticia['titulo']); ?></h1>
                <img src="<?php echo $noticia['foto']; ?>"><br>
                <small>Categoría: <?php echo htmlspecialchars($noticia['categoria']); ?> - Fecha:
                    <?php echo $noticia['fecha']; ?></small>
                <p><?php echo nl2br(htmlspecialchars($noticia['descripcion'])); ?></p>
                <small>Autor:</small>
                <p><?php echo $noticia['user_id']; ?></p>
            <?php else: ?>
                <!-- Si no existe la noticia -->
                <p>❌ Noticia no encontrada.</p>
            <?php endif; ?>
            <!-- Enlaces para volver y eliminar la noticia -->
            <a href="index.php">← Volver</a>
            <a href="eliminar_noticia.php?id=<?PHP echo $id; ?>&foto=<?php echo $noticia['foto'];?>" onclick="return confirm('Esto eliminará definitivamente la noticia ¿Quieres continuar?')">❌ Eliminar noticia</a>
        </div>

        <!-- Formulario para editar la noticia -->
        <div id="form" class="tarjeta">
            <h1>EDITAR NOTICIA</h1>
            <form action="editar_noticia.php" method="POST" enctype="multipart/form-data">
                <!-- Foto antigua para reemplazo si se sube una nueva -->
                <input type="hidden" name="fotoAntigua" value="<?php echo $noticia['foto']; ?>">
                <label for="titulo">Título de la noticia:</label>
                <input type="text" name="titulo" id="titulo" value="<?php echo $noticia['titulo']; ?>">
                <span class="error">* </span>
                <br>
                <label for="user_id">Autor:</label>
                <!-- El autor es solo lectura -->
                <input type="number" name="user_id" id="user_id" value="3" readonly>
                <span class="error">* </span>
                <br>
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
                            // Marca como seleccionada la categoría actual
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
                <!-- Campo para subir nueva foto -->
                <input type="file" name="foto" id="foto" accept="image/*">
                <br>
                <label for="descripcion">Descripcion:</label>
                <!-- Área de texto para la descripción -->
                <textarea name="descripcion" id="descripcion" placeholder="Contenido de la noticia">
                    <?php echo $noticia['descripcion']; ?>
                </textarea>
                <!-- ID oculto para identificar la noticia al editar -->
                <input type="hidden" name="id" value="<?= $noticia['id']; ?>">
                <span class="error">* </span>
                <br><br>
                <input type="submit" value="Enviar">
            </form>
        </div>
    </div>
    <?php require_once "partials/footer.php"; ?>
</body>

</html>