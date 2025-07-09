<?php
require_once "conexion.php";
$tituloErr = $user_idErr = $categoriaErr = $descripcionErr = $insertarErr = "";
$titulo = $user_id = $categoria = $descripcion = $insertaSuccess = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /*$nombre = test_input($_POST['nombre']);
    $email = test_input($_POST['email']);
    $enlace = test_input($_POST['enlace']);
    $descripcion = test_input($_POST['descripcion']);*/

    if (!isset($_POST["titulo"]) || empty($_POST["titulo"])) {

        http_response_code(400); // Faltan parámetros.
        $tituloErr = "Tienes que introducir un nombre";
    } else {
        /*   if (!preg_match("/^[a-zA-Z-' ]*$/", $titulo)) {
               $nombreErr = "Introduce solo letras mayúsculas o minúsculas";
           }*/
        $titulo = test_input($_POST["titulo"]);
    }
    if (!isset($_POST["user_id"]) || empty($_POST["user_id"])) {
        $user_idErr = "Tienes que introducir un id de usuario";
    } else {
        /*  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $emailErr = "Tienes que introducir un email válido";
          }*/
        $user_id = (int) $_POST["user_id"];
    }

    if (!isset($_POST["categoria"]) || empty($_POST["categoria"])) {
        $categoriaErr = "Tienes que introducir un categoria";
    } else {
        /*if (!filter_var($categoria, FILTER_VALIDATE_URL)) {
            $categoriaErr = "Tienes que introducir un categoria válido";
        }*/
        $categoria = test_input($_POST["categoria"]);
    }
    if (!isset($_POST["descripcion"]) || empty($_POST["descripcion"])) {
        $textareErr = "Tienes que introducir algún texto";
    } else {
        /*if (!filter_var($enlace, FILTER_VALIDATE_URL)) {
            $descripcionErr = "Tienes que introducir un descripcion válido";
        }*/
        $descripcion = test_input($_POST["descripcion"]);
    }

    /*if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }*/
try {
    $stmt = $pdo->prepare("INSERT INTO noticias (titulo, descripcion, categoria, user_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$titulo, $descripcion, $categoria, $user_id]);
    $insertaSuccess = "Datos insertados correctamente";
} catch (PDOException $e) {
    $insertarErr = "Error al insertar los datos: " . $e->getMessage();
}
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    /*if ($tipo === "email")*/
    return $data;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validaciones inputs</title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            padding: 2rem;
            display: flex;
            justify-content: center;
        }

        /* Estilo del formulario */
        form {
            background-color: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        /* Etiquetas */
        label {
            font-weight: 600;
            margin-bottom: 0.3rem;
            color: #333;
        }

        /* Inputs y select */
        input[type="text"],
        input[type="number"],
        select,
        textarea {
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            width: 100%;
            box-sizing: border-box;
            transition: border 0.3s ease;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.1);
        }

        /* Textarea */
        textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* Botón */
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 0.8rem;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Mensajes de error */
        .error {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: -0.5rem;
        }
    </style>
</head>

<body>
    <h1 class="error"><?php echo $insertarErr; ?></h1>
    <h1>Formulario de inserción de noticias</h1>
    <form action="insert.php" method="POST">
        <label for="titulo">Título de la noticia:</label>
        <input type="text" name="titulo" id="titulo" value="<?php echo $titulo; ?>">
        <span class="error">* <?php echo $tituloErr; ?></span>
        <br>
        <label for="user_id">Autor:</label>
        <input type="number" name="user_id" id="user_id" value="3" readonly>
        <span class="error">* <?php echo $user_idErr; ?></span>
        <br>
        <label for="categoria">Categoría:</label>
        <select name="categoria" id="categoria">
            <option value="Noticias">Noticias</option>
            <option value="Curiosidades">Curiosidades</option>
            <option value="Deportes">Deportes</option>
        </select>
        <br>
        <label for="descripcion">Descripcion:</label>
        <textarea name="descripcion" id="descripcion"
            placeholder="Contenido de la noticia"><?php echo $descripcionErr; ?></textarea>
        <span class="error">* <?php echo $descripcionErr; ?></span>
        <br><br>
        <input type="submit" value="Enviar">
    </form>

</body>

</html>