<?php

if (isset($_SESSION['id'])) header('location: index.php');
require_once "functions.php";
require_once "conexion.php";

$errorGeneral = "";
if ($_SERVER['REQUEST_METHOD']=='POST'){
    if (isset($_POST['password']) && isset($_POST['email'])){
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user){
             http_response_code(404);
             $errorGeneral = "No esxiste el usuario, <a href='registro.php'>regístrese</a>";
            
        }else{
            
            if (!password_verify($pass, $user['password'])){
                http_response_code(401);
                $errorGeneral = "Credenciales incorrectas, inténtelo de nuevo ". password_hash($pass, PASSWORD_DEFAULT) . ' - ' . $user['password'];
            }else{
                $_SESSION['nombre'] = $user['nombre'];
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                header('location: index.php');
            }
        }
    }else{
        http_response_code(400);
        echo "Faltan parámetros obligatorios";
    }
}
