<?php
require_once "functions.php";
require_once "conexion.php";
$comienzo = 0;
$num = 3;
$where = "";
$queryStringCategorias = '';
if (isset($_GET['comienzo'])) $comienzo = $_GET['comienzo'];
if (isset($_GET['categoria'])){
    $categoria = $_GET['categoria'];
    $where = "WHERE categoria = '$categoria'";
    $queryStringCategorias = "&categoria=$categoria";
} 

$stmt = $pdo->query("SELECT * FROM noticias $where ORDER BY fecha DESC LIMIT $comienzo, $num");
// "SELECT * FROM noticias WHERE categoria=noticias ORDER BY fecha DESC LIMIT 0, 3"
$noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Listado de noticias</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>

<body>
    <?php require_once "partials/header.php"; ?>
    <h1>Últimas noticias</h1>
    <?php foreach ($noticias as $noticia): ?>
        <div class="noticia">
            <h2><?= htmlspecialchars($noticia['titulo']) ?></h2>
            <small>Categoría:
                <!-- Enlace a la categoría del post -->
              <a href="<?php echo $_SERVER['PHP_SELF'].'?categoria='.$noticia['categoria'];?>">
                <?= htmlspecialchars($noticia['categoria']) ?>
              </a>  
                | Fecha:
                <?= $noticia['fecha'] ?></small><br>
            <a class="vermas" href="noticia.php?id=<?= $noticia['id'] ?>">Ver más</a>
        </div>
    <?php endforeach; ?>
<div class="navegacion">
    <?php
    // Paginación
    if ($comienzo > 0) {
        echo "
        <a href='" . $_SERVER['PHP_SELF'] . "?comienzo=".($comienzo-$num)."$queryStringCategorias' class='anteriorSiguiente'><< Anterior</a>
        ";
    }
 
    $stmt = $pdo->query("SELECT COUNT(*) FROM noticias $where");
    $total = $stmt->fetchColumn();  // fetch, fectAll y fetchColumn
    if ($comienzo+$num < $total){
        echo "
            <a href='" . $_SERVER['PHP_SELF'] . "?comienzo=".($comienzo+$num)."$queryStringCategorias' class='anteriorSiguiente'>Siguiente >></a>
        ";
    }
    ?>
</div>
    <?php require_once "partials/footer.php"; ?>
</body>

</html>