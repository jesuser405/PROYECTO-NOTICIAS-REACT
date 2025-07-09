<?php
// INI
$host = "localhost";
$user = "jesus405"; // Default user for MAMP is 'root'
$password = "Jk123456$45"; // Default password for MAMP is 'root'
$database = "curso_nascor1";
try {
  $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $user, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die(" Error de conexión: " . $e->getMessage());
}
