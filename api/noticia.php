<?php
// En este archivo vemos la noticia completa y mostramos a su vez el formulario de edición
// que se enviará a editar_noticia.php
//
//require_once "functions.php";
require_once "conexion.php";
if (!isset($_GET['id']) || empty($_GET['id'])) {
    http_response_code(405);
    echo "Faltan parámetros obligatorios";
    //header('location: index.php');
    exit;
}
$id = $_GET['id'];
                        // $stmt = $pdo->prepare("SELECT * FROM noticias WHERE id = ?");
                                // Añadimos Join con usuarios para obtener también el nombre del autor de la noticia
$stmt = $pdo->prepare("SELECT noticias.*, usuarios.email, usuarios.nombre FROM noticias JOIN usuarios ON noticias.user_id = usuarios.id WHERE noticias.id = ?");

$stmt->execute([$id]);
$noticia = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($noticia);
exit;
