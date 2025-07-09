<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo "<header style='background-color: #f8f8f8; padding: 20px; text-align: center; font-family: Arial, sans-serif;'>";
    echo "<h1 style='margin: 0; font-size: 24px;'>Mi Página Inspirada en Apple</h1>";
    echo "</header>";

    echo "<nav style='background-color: #333; padding: 10px;'>";
    echo "<ul style='list-style: none; margin: 0; padding: 0; display: flex; justify-content: center;'>";
    echo "<li style='margin: 0 15px;'><a href='#' style='color: white; text-decoration: none;'>Inicio</a></li>";
    echo "<li style='margin: 0 15px;'><a href='#' style='color: white; text-decoration: none;'>Productos</a></li>";
    echo "<li style='margin: 0 15px;'><a href='#' style='color: white; text-decoration: none;'>Acerca de</a></li>";
    echo "<li style='margin: 0 15px;'><a href='#' style='color: white; text-decoration: none;'>Contacto</a></li>";
    echo "</ul>";
    echo "</nav>";

    echo "<main style='font-family: Arial, sans-serif; padding: 20px; text-align: center;'>";
    echo "<section style='margin-bottom: 40px;'>";
    echo "<h2 style='font-size: 28px; color: #333;'>Bienvenido a Mi Página</h2>";
    echo "<p style='font-size: 18px; color: #555;'>Explora nuestros productos y descubre lo mejor en tecnología.</p>";
    echo "</section>";

    echo "<section style='display: flex; justify-content: center; gap: 20px;'>";
    echo "<div style='border: 1px solid #ddd; border-radius: 10px; padding: 20px; width: 300px;'>";
    echo "<img src='https://via.placeholder.com/300' alt='Producto 1' style='width: 100%; border-radius: 10px;'>";
    echo "<h3 style='font-size: 20px; color: #333;'>Producto 1</h3>";
    echo "<p style='font-size: 16px; color: #555;'>Descripción breve del producto.</p>";
    echo "</div>";

    echo "<div style='border: 1px solid #ddd; border-radius: 10px; padding: 20px; width: 300px;'>";
    echo "<img src='https://via.placeholder.com/300' alt='Producto 2' style='width: 100%; border-radius: 10px;'>";
    echo "<h3 style='font-size: 20px; color: #333;'>Producto 2</h3>";
    echo "<p style='font-size: 16px; color: #555;'>Descripción breve del producto.</p>";
    echo "</div>";
    echo "</section>";
    echo "</main>";

    echo "<footer style='background-color: #f8f8f8; padding: 20px; text-align: center; font-family: Arial, sans-serif;'>";
    echo "<p style='margin: 0; font-size: 14px; color: #777;'>© 2023 Mi Página Inspirada en Apple. Todos los derechos reservados.</p>";
    echo "</footer>";
    
    phpinfo(); //Función propia de php que escribe html por sí sola con los datos // de la máquina

    ?>

    
</body>
</html>