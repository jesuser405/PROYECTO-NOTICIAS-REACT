<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORREO</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form action="enviar_correo.php" method="post">
            <h1>Formulario de Contacto</h1><br>
            <label for="mail">Correo electrónico:</label>
            <input type="email" id="mail" name="mail" required><br><br>

            <label for="subject">Asunto:</label>
            <input type="text" id="subject" name="subject" required><br><br>

            <label for="message">Mensaje:</label>
            <textarea id="message" name="message" rows="4" required></textarea><br><br>

            <button type="submit">Enviar Correo</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2023 Cursos con Luis | 104 Cubes. Todos los derechos reservados.</p>
        <p><a href="https://www.google.com" target="_blank">Visita nuestro sitio web</a></p>
    </footer>
</body>
</html>
