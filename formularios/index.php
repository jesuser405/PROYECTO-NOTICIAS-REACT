<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background-color: #121212; color: #ffffff; font-family: Arial, sans-serif; margin: 0; padding: 0;"></body>
    <!-- Formulario que envía datos a welcome.php mediante el método POST -->
    <form id="form" action="welcome.php" method="POST" style="max-width: 400px; margin: 50px auto; padding: 20px; background-color: #1e1e1e; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
       <!-- Campo para ingresar el nombre -->
       <label for="name" style="display: block; margin-bottom: 8px;">Name:</label>
       <input type="text" id="name" name="name" value="" style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #333; border-radius: 4px; background-color: #2c2c2c; color: #ffffff;">
       
       <!-- Campo para ingresar el correo electrónico -->
       <label for="email" style="display: block; margin-bottom: 8px;">E-mail:</label>
       <input type="text" id="email" name="email" style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #333; border-radius: 4px; background-color: #2c2c2c; color: #ffffff;">
       
       <!-- Botón para enviar el formulario -->
       <input type="submit" value="Submit" style="width: 100%; padding: 10px; border: none; border-radius: 4px; background-color: #007bff; color: #ffffff; font-weight: bold; cursor: pointer;">
   </form>
</body>
</html>