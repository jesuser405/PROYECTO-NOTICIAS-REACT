<?php

require_once "conexion.php";
require_once "functions.php";

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
// "SELECT * FROM noticias WHERE categoria='noticias' ORDER BY fecha DESC LIMIT 0, 3"
$noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($noticias);
exit;