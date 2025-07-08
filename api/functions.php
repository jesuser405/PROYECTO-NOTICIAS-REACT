<?php
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

function esTuya($noticia)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT user_id FROM noticias WHERE id = '$noticia' AND user_id = '".$_SESSION['id']."'");

    $stmt->execute([$noticia, $_SESSION['id']]);
    $noticia = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($noticia) {
        return true;
    }
    return false;
}
