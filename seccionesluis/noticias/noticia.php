<?php
// En este archivo vemos la noticia completa y mostramos a su vez el formulario de edición
// que se enviará a editar_noticia.php
require_once "sesiones.php";
require_once "functions.php";
require_once "conexion.php";
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('location: index.php');
}
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM noticias WHERE id = ?");
$stmt->execute([$id]);
$noticia = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($noticia['titulo'] ?? 'Noticia no encontrada'); ?></title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>

<body>
    <?php require_once "partials/header.php"; ?>
    <div id="main">
        <div class="tarjeta">
            <?php if ($noticia): ?>
                <h1><?php echo htmlspecialchars($noticia['titulo']); ?></h1>
                <img src="<?php echo $noticia['foto']; ?>"><br>
                <small>Categoría: <?php echo htmlspecialchars($noticia['categoria']); ?> - Fecha:
                    <?php echo $noticia['fecha']; ?></small>
                <p><?php echo nl2br(htmlspecialchars($noticia['descripcion'])); ?></p>
                <small>Autor:</small>
                <p><?php echo $noticia['user_id']; ?></p>
            <?php else: ?>
                <p>❌ Noticia no encontrada.</p>
            <?php endif; ?>
            <a href="index.php">← Volver</a>
            <?php if (isset($_SESSION['id'])) { ?>
                <a href="eliminar_noticia.php?id=<?PHP echo $id; ?>&foto=<?php echo $noticia['foto']; ?>" onclick="return confirm('Esto eliminará definitivamente la noticia ¿Quieres continuar?')">❌ Eliminar noticia</a>
            <?php } ?>
        </div>
        <?php if (isset($_SESSION['id'])) { ?>
            <!-- COMIENZA LA EDICION DE LA NOTICIA -->
            <div id="form" class="tarjeta">
                <h1>EDITAR NOTICIA</h1>
                <form action="editar_noticia.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="fotoAntigua" value="<?php echo $noticia['foto']; ?>">
                    <label for="titulo">Título de la noticia:</label>
                    <input type="text" name="titulo" id="titulo" value="<?php echo $noticia['titulo']; ?>">
                    <span class="error">* </span>
                    <br>
                    <!--<label for="user_id">Autor:</label>-->
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['id'];?>" readonly>
                    <span class="error">* </span>
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
                    <input type="file" name="foto" id="foto" accept="image/*">
                    <br>
                    <label for="descripcion">Descripcion:</label>
                    <textarea name="descripcion" id="descripcion" placeholder="Contenido de la noticia">
                    <?php echo $noticia['descripcion']; ?>
                </textarea>
                    <input type="hidden" name="id" value="<?= $noticia['id']; ?>">
                    <span class="error">* </span>
                    <br><br>
                    <input type="submit" value="Enviar">
                </form>
            </div>
        <?php } // Cierre del if (isset($_SESSION['id'])) ?>
    </div>

    <?php require_once "partials/footer.php";
    ?>
</body>

</html>