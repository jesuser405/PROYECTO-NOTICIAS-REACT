<?php
// Incluye el archivo de conexión a la base de datos
require_once "conexion.php";
require_once "funciones_generales.php"; // Incluye las funciones generales
require_once "sessiones.php"; // Incluye el archivo de sesiones para manejar la sesión del
if (!isset($_SESSION['id'])) {
    header('location: login.php');
    exit; // Asegura que la sesión esté iniciada antes de continuar
}
// Verifica si el parámetro 'id' está presente y no está vacío
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('location: index.php'); // Redirigir al índice si falta el id
} else {
    $id = intval($_GET["id"]); // Convierte el id a entero
    try {
        // Prepara la consulta para eliminar la noticia con el id proporcionado
        $stmt = $pdo->prepare("DELETE FROM noticias WHERE id = ?");
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            // Elimina la foto del servidor usando la ruta proporcionada en 'foto'
            if (isset($_GET['foto']) && !empty($_GET['foto'])) {
                unlink($_GET['foto']);
            }
            echo "Noticia eliminada correctamente.";
        } else {
            echo "No se encontró la noticia con el ID proporcionado.";
        }
        header("Location: index.php"); // Redirige a la página principal después de eliminar    
    } catch (PDOException $e) {
        // Muestra un mensaje de error si ocurre una excepción
        echo "Error al eliminar la noticia: " . $e->getMessage();
    }
    // Redirige a la página principal después de eliminar
    return header("Location: noticia.php?id=" . $id . "&error=true");
}
