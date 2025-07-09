<?php
// Incluir archivos necesarios para la sesión, funciones y conexión a la base de datos
require_once "sesiones.php";
require_once "functions.php";
require "conexion.php";

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id'])) { 
    header('location: login.php'); // Redirigir a login si no hay sesión
}

// Verificar si se ha recibido el parámetro 'id' por GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('location: index.php'); // Redirigir al índice si falta el id
}

try {
    // Convertir el id recibido a entero
    $id = intval($_GET['id']);
    // Preparar y ejecutar la consulta para eliminar la noticia
    $stmt = $pdo->prepare("DELETE FROM noticias WHERE id = ?");
    $stmt->execute([$id]);
    // Si se recibe el parámetro 'foto', eliminar el archivo correspondiente
    if (isset($_GET['foto']) && !empty($_GET['foto'])) {
        unlink($_GET['foto']);
    }
    // Redirigir al índice tras eliminar
    header('location: index.php');
} catch (Exception $e) {
    // En caso de error, devolver código 500 y redirigir a la noticia con error
    http_response_code(500);
    header('location: noticia.php?id=' . $id . '&error=true');
}
