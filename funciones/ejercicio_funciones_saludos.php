<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        :root{
            color-scheme: dark;
        }
        body {
            display: grid;
            place-content: center;
        }
    </style>
</head>
<body>

    <?php
      function saludar($nombre, $hora){
        if ($hora < 12) {
            echo "Buenos días $nombre";
        } elseif ($hora < 20) {
            echo "Buenas tardes $nombre";
        } else {
            echo "Buenas noches $nombre";
        }
      
      }
      echo saludar("Pablo", 10);
      echo "<br>";
      echo saludar("Jesus", 15);
      echo "<br>";
      echo saludar("Luis", 22);
      echo "<br>";
       
      ?>
</body>
</html>