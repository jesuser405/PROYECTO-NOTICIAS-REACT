<?php

require_once "functions.php";
require "conexion.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('location: index.php');
}

try {
    $id = intval($_GET['id']);
    if (!esTuya($id)) {
        http_response_code(405);
        $errorGenerl = "No puedes realizar esta acción";
        header('location: noticia.php?id=' . $id . '&error=true');
        exit;
    }
    $stmt = $pdo->prepare("DELETE FROM noticias WHERE id = ?");
    $stmt->execute([$id]);
    if (isset($_GET['foto']) && !empty($_GET['foto'])) {
        unlink($_GET['foto']);
    }
   // header('location: index.php');
} catch (Exception $e) {
    http_response_code(500);
    header('location: noticia.php?id=' . $id . '&error=true');
}
