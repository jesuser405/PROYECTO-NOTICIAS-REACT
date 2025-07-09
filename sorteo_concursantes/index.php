<?php
define("Archivo", "Listaconcursantes.txt");
session_start();

function limpiarConcursantes() {
    $_SESSION['concursantes'] = [];
}

function premioAleatorio($concursantes) {
    if (count($concursantes) > 0) {
        return $concursantes[array_rand($concursantes)];
    }
    return null;
}

// Inicializar desde archivo si la sesión está vacía
if (!isset($_SESSION['concursantes']) || empty($_SESSION['concursantes'])) {
    if (file_exists(Archivo)) {
        $_SESSION['concursantes'] = array_filter(array_map('htmlspecialchars', file(Archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)));
    } else {
        $_SESSION['concursantes'] = [];
    }
}

$ganador = null;

// Manejar acciones del formulario  
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["nombre"]) && $_POST["nombre"] !== "") {
        $nombre = trim($_POST["nombre"]);
        if ($nombre !== "") {
            $nombreLimpio = htmlspecialchars($nombre);
            $_SESSION['concursantes'][] = $nombreLimpio;
            file_put_contents(Archivo, $nombreLimpio . PHP_EOL, FILE_APPEND); // Guardar en archivo
        }
    } elseif (isset($_POST["limpiar"])) {
        limpiarConcursantes();
        file_put_contents(Archivo, ""); // Vaciar archivo
    } elseif (isset($_POST["sortear"])) {
        $ganador = premioAleatorio($_SESSION['concursantes']);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sorteo - Concursantes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
            padding: 40px;
            max-width: 600px;
            margin: auto;
        }

        h1, h2, h3 {
            text-align: center;
            color: #444;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        button {
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
        }

        button[name="sortear"] {
            background-color: #007BFF;
            color: white;
        }

        button[name="limpiar"] {
            background-color: #dc3545;
            color: white;
        }

        button:hover {
            opacity: 0.9;
        }

        ul {
            list-style-type: none;
            padding-left: 0;
            background: #fff;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }

        li {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        li:last-child {
            border-bottom: none;
        }

        h3 {
            background-color: #dff0d8;
            color: #3c763d;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Sorteo - Agregar Concursantes</h1>

    <form method="post">
        <label for="nombre">Nombre del concursante:</label>
        <input type="text" id="nombre" name="nombre" required>
        <button type="submit">Agregar</button>
    </form>

    <form method="post" style="margin-top: 10px;">
        <button type="submit" name="sortear">🎉 Sortear ganador</button>
        <button type="submit" name="limpiar">🗑️ Limpiar concursantes</button>
    </form>

    <h2>Lista de Concursantes</h2>
    <ul>
        <?php foreach ($_SESSION['concursantes'] as $c): ?>
            <li><?= $c ?></li>
        <?php endforeach; ?>
    </ul>

    <?php if ($ganador): ?>
        <h3>🎊 ¡Ganador del sorteo: <?= $ganador ?>! 🎊</h3>
    <?php endif; ?>
</body>
</html>
