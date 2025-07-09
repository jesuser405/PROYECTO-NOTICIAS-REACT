<?php
require 'clase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form = new Formulario();

    $form->setName($_POST['nombre']);
    $form->setApellido($_POST['apellido']);
    $form->setEmail($_POST['email']);
    $form->setEmpleo($_POST['empleo']);
    $form->setTitulacion($_POST['titulacion']);
    $form->setComentario($_POST['comentario']);

    echo "<h2>Datos recibidos:</h2>";
    echo "<strong>Nombre:</strong> " . htmlspecialchars($form->getName()) . "<br>";
    echo "<strong>Apellido:</strong> " . htmlspecialchars($form->getApellido()) . "<br>";
    echo "<strong>Email:</strong> " . htmlspecialchars($form->getEmail()) . "<br>";
    echo "<strong>Empleo:</strong> " . htmlspecialchars($form->getEmpleo()) . "<br>";
    echo "<strong>Titulación:</strong> " . htmlspecialchars($form->getTitulacion()) . "<br>";
    echo "<strong>Comentario:</strong> " . nl2br(htmlspecialchars($form->getComentario())) . "<br>";
} else {
    echo "Acceso no permitido.";
}

