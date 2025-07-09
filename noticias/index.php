<?php
// Incluimos los archivos necesarios para la conexión y funciones generales
require_once "conexion.php";
require_once "funciones_generales.php";
 // Incluimos el archivo de sesiones para manejar la sesión del usuario

// Variables para la paginación
$comienzo = 0; // Inicio de la paginación
$num = 5; // Número de noticias por página

// Inicializamos variables para la consulta SQL y la cadena de consulta de categorías
$where = "";
$queryStringCategorias = '';

// Si se recibe el parámetro 'comienzo' por GET, lo asignamos
if (isset($_GET['comienzo'])) $comienzo = $_GET['comienzo'];

// Si se recibe el parámetro 'categoria' por GET, filtramos por esa categoría
if (isset($_GET['categoria'])){
   $categoria = $_GET['categoria'];
   $where = "WHERE categoria = '$categoria'";
   $queryStringCategorias = "&categoria=$categoria";
} 

// Consulta para obtener las noticias según la paginación y el filtro de categoría
$stmt = $pdo->query("SELECT * FROM noticias $where ORDER BY fecha DESC LIMIT $comienzo, $num");
$noticias = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtenemos todas las noticias como array asociativo
?>
<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <title>Listado de noticias</title>
   <link rel="stylesheet" href="CSS/css.css">
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
   // Paginación: enlace a la página anterior si corresponde
   if ($comienzo > 0) {
      echo "
      <a href='" . $_SERVER['PHP_SELF'] . "?comienzo=".($comienzo-$num)."$queryStringCategorias' class='anteriorSiguiente'><< Anterior</a>
      ";
   }
 
   // Obtenemos el total de noticias para saber si hay más páginas
   $stmt = $pdo->query("SELECT COUNT(*) FROM noticias $where");
   $total = $stmt->fetchColumn();

   // Paginación: enlace a la página siguiente si corresponde
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