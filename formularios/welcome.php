<?php
// WELCOME.PHP

// Verifica si los parámetros 'name' y 'email' están definidos en el formulario POST
// y si no están vacíos
if (isset($_POST["name"]) && isset($_POST["email"]) && $_POST['name'] != '' && $_POST['email'] != '') { 
    ?>
    <!-- Muestra un mensaje de bienvenida con el nombre y el correo electrónico -->
    Welcome
    <?php echo $_POST["name"]; ?><br>
    Your email address is:
    <?php echo $_POST["email"]; ?>
<?php 
} else {
    // Si faltan parámetros, muestra un mensaje de error y devuelve un código de respuesta HTTP 400
    echo "ERROR, faltan parámetros";
    http_response_code(400);
}
?>