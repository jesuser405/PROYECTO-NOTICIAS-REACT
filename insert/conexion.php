<?php
// INI
$host = "localhost";
$user = "jesus"; // Default user for MAMP is 'root'
$password = "123456"; // Default password for MAMP is 'root'
$database = "cursonascor";

try {
  $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $user, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die(" Error de conexión: " . $e->getMessage());
}
