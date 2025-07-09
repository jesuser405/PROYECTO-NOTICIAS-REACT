<?php
// Configuración de la conexión a la base de datos
$host = "localhost";
$user = "jesus405"; // Usuario de la base de datos
$password = "Jk123456$45"; // Contraseña de la base de datos
$database = "cursonascor"; // Nombre de la base de datos

try {
  // Crear una nueva conexión PDO a MySQL con codificación utf8mb4
  $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $user, $password);
  // Configurar el modo de error para que lance excepciones
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  // Mostrar mensaje de error si la conexión falla
  die(" Error de conexión: " . $e->getMessage());
}
