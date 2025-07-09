<?php
session_start();
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
            if ($pass != $user['password']){
                http_response_code(401);
                $errorGeneral = "Credenciales icncorrectas, inténtelo de nuevo";
            }else{
                $_SESSION['nombre'] = $user['nombre'];
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                header('location: index.php');
                exit;
            }
        }
    }else{
        http_response_code(400);
        echo "Faltan parámetros obligatorios";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesiones Login</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
    <?php require_once "partials/header.php"; ?>
    <span style="color:red;"><?php echo $errorGeneral;?></span>
    <h1>LOGIN</h1>

    <form action="login.php" method="post">
        Email: <br>
        <input type="text" name="email"><br>
        Password: <br>
        <input type="password" name="password"><br>
        <input type="submit">
    </form>
</body>
</html>